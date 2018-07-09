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
        $observation->setPicture('5b2a6d5d63668228460405.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(3);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();


        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.62545');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(2);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('5.62545');
        $observation->setPicture('5b439c1811327988108571.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(1);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.62545');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(2);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.6545');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Superbe oiseau !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(2);
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