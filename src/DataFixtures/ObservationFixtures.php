<?php

namespace App\DataFixtures;

use App\Entity\Observation;
use App\Entity\Bird;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ObservationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('2.62545');
        $observation->setPicture('assets/img/eagle.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');


        $bird = new Bird();
        $bird->setLbNom('Accipiter bicolor');
        $bird->setNomVern('Epervier bicolore ');
        $observation->setBird($bird);

        $user = new user();
        $user->setUsername('toto');
        $user->setEmail('to@gmail.com');
        $user->setPassword('pass');
        $observation->setUser($user);

        $manager->persist($observation);
        $manager->flush();

    }
    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 25;
    }

}