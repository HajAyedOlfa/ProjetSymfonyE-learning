<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Faker;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker=Factory::create();
        for($i=0;$i<10;$i++){
            $participant = new Participant();
            $participant->setNomP($faker->firstName);
            $participant->setPrenomP($faker->lastName);
            $participant->setEmail($faker->email);
            $participant->setNomCours("PHP");
            $manager->persist($participant);

        }

        $manager->flush();
    }
}
