FROM php:7.2-apache

COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod proxy_fcgi ssl rewrite proxy proxy_balancer proxy_http proxy_ajp

RUN apt-get update \
&& apt-get install -y libzip-dev libpq-dev libmcrypt-dev git zlib1g zip unzip libmagickwand-dev --no-install-recommends \
&& docker-php-ext-configure zip \
&& docker-php-ext-install zip pdo pdo_mysql mysqli gd mbstring

RUN apt-get install -y sloccount

RUN pecl install imagick \
    && docker-php-ext-enable zip \
    && pecl install xdebug \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable xdebug


#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/

