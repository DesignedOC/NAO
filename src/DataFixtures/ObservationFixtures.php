<?php

namespace App\DataFixtures;

use App\Entity\Observation;
use App\Entity\Bird;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ObservationFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('2.62545');
        $observation->setPicture('uploads/observations/5b2a820b90c58533077425.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
       $bird = $manager->getRepository('App:Taxref')->find(352);
       $user = $manager->getRepository('App:User')->find(3);
       $observation->setBird($bird);
       $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();


        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.62545');
        $observation->setPicture('uploads/observations/5b2a820b90c58533077425.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Taxref')->find(352);
        $user = $manager->getRepository('App:User')->find(2);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('5.62545');
        $observation->setPicture('uploads/observations/5b2a820b90c58533077425.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Taxref')->find(352);
        $user = $manager->getRepository('App:User')->find(1);
        $observation->setBird($bird);
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