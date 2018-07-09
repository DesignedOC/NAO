<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    // $user = $userManager->createUser();
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addRole('ROLE_SUPER_ADMIN');
         $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('natu@natu.com');
        $user->setUsername('natu');
        $user->setPlainPassword('natu');
        $user->setEnabled(true);
        $user->addRole('ROLE_NATURALIST');
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('user@user.com');
        $user->setUsername('user');
        $user->setPlainPassword('user');
        $user->setEnabled(true);
        $user->addRole('ROLE_USER');
        $manager->persist($user);
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }

}
