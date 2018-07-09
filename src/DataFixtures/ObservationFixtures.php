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
        $observation->setDescription('Superbe oiseau observé à côté de la ville!');
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
        $observation->setDescription('Oiseau observé le matin , il était en groupe !');
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
        $observation->setDescription('Observation effectué vers 16 h près du bois de st Amand!');
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
        $observation->setStatut('1');
        $observation->setDescription('observation d\'un oiseau isolé !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(3);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.6945');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('1');
        $observation->setDescription('Observation près d\'un bois lors d\'une promenade !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(3);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('49.2555');
        $observation->setLongitude('3.6945');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('1');
        $observation->setDescription('Observation de nuit !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(3);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.4255');
        $observation->setLongitude('3.9345');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Observation au bord d\'un lac !');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(3);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('3.7945');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Oiseau au pelage magnifique observé près d\'un bosquet');
        $bird = $manager->getRepository('App:Bird')->find(2);
        $user = $manager->getRepository('App:User')->find(2);
        $observation->setBird($bird);
        $observation->setUser($user);
        $manager->persist($observation);
        $manager->flush();

        $observation = new Observation();
        $observation->setDate(new \DateTime());
        $observation->setLatitude('48.2555');
        $observation->setLongitude('4.6945');
        $observation->setPicture('5b3b75f9a55be877382999.jpg');
        $observation->setStatut('2');
        $observation->setDescription('Observation près d\'un bois lors d\'une promenade !');
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