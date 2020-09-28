<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\CarCategory;
use App\Entity\Dealer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i < 10; $i++) {
            $this->createDealer($manager, $faker);
        }

        for ($i = 1; $i < 5; $i++) {
            $this->createCategory($manager, $faker);
        }

        for ($i = 1; $i < 5; $i++) {
            $this->createCar($manager, $i, $faker);
        }

        $manager->flush();
    }


    private function createDealer(ObjectManager $manager, $faker)
    {
        $dealer = new Dealer();
        $dealer->setName($faker->name);
        $manager->persist($dealer);
        $manager->flush();
    }

    private function createCategory(ObjectManager $manager, $faker)
    {
        $carCategory = new CarCategory();
        $carCategory->setName($faker->name);
        $manager->persist($carCategory);
        $manager->flush();
    }

    private function createCar(ObjectManager $manager, $n, $faker)
    {
        $car = new Car();
        $car->setEngine($n * 1000);
        $car->setModel($faker->name);
        $car->setWheels(4);
        $car->setCategory($manager->getRepository(CarCategory::class)->find($n));
        $car->setDealer($manager->getRepository(Dealer::class)->find($n));
        $manager->persist($car);
        $manager->flush();
    }
}
