NOTAS

pruebas graphql

composer create-project symfony/skeleton exampleproject '4.4.*'
composer require serializer
composer require annotations
composer require orm 
composer require orm-fixtures –dev
composer require api

crear el .htaccess en public

<IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /index.php/
    </IfModule>
</IfModule>

ya podemos acceder a /api

-----------------------------------------------
instalando graphql

docker-compose exec apache-php composer req webonyx/graphql-php && docker-compose exec apache-php bin/console cache:clear

echo eso ya es accesible via:

http://graphql.local:8091/api/graphql

consulta de prueba:

{
	carCategory(id: "api/car_categories/1") {
		id
		name
	}
}


consulta conjunta:

{
  car(id: "api/cars/1") {
		id
		wheels
    model
  }  
  
  	carCategory(id: "api/car_categories/1") {
		id
		name
	}
}
---------------traer una coleccion

{
	cars{
    edges
    {
      node{
        id
        wheels
        model
      }
    }
  }
}
---------------------------consulta una coleccion añadiendo campos anidados

{
	cars{
    edges
    {
      node{
        id
        wheels
        model
        engine
        category{
          name
        }
        dealer{
          id
          name
        }
      }
    }
  }
}
--------------------------creando un api filter podemos filtrar tanto en api platform como en graphql

/**
 * @ApiResource()
 * @ApiFilter(NumericFilter::class, properties={"wheels"})
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */

curl -X GET "http://graphql.local:8091/api/cars?wheels=3&page=1" -H  "accept: application/ld+json"


{
	cars(wheels: 3){
    edges
    {
      node{
        id
        wheels
        model
        engine
        category{
          name
        }
        dealer{
          id
          name
        }
      }
    }
  }
}

------------------------------------tb podemos especificar los campos de ordenacion tal que:
/**
 * @ApiResource()
 * @ApiFilter(NumericFilter::class, properties={"wheels"})
 * @ApiFilter(OrderFilter::class, properties={"id", "wheels"}, arguments={"orderParameterName"="order"})
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */

curl -X GET "http://graphql.local:8091/api/cars?order%5Bwheels%5D=asc&page=1" -H  "accept: application/ld+json"

{
	cars(order:{id:"desc"}){
    edges
    {
      node{
        id
        wheels
        model
        engine
        category{
          name
        }
        dealer{
          id
          name
        }
      }
    }
  }
}
--------------fitro de rangos

* @ApiFilter(RangeFilter::class, properties={"price"})

curl -X GET "http://graphql.local:8091/api/cars?engine%5Bbetween%5D=1000%262000&page=1" -H  "accept: application/ld+json"

{
	cars(order:{id:"desc"}, engine:{gt:"2000"}){
    edges
    {
      node{
        id
        wheels
        model
        engine
        category{
          name
        }
        dealer{
          id
          name
        }
      }
    }
  }
}


----------------------------------------------------------------------
EN DEFINITIVA, VENTAJAS DE GRAPHQL VS API REST NORMAL:




