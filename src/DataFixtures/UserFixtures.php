<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * Sets the container.
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        //$user = new User();
        $user->setEmail('admin@admin.com');
        $user->setUsername('admin');
        $user->setPlainPassword('5c23tjLG');
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');
         $manager->persist($user);
        $manager->flush();

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        //$user = new User();
        $user->setEmail('natu@natu.com');
        $user->setUsername('naturaliste');
        $user->setPlainPassword('5Mb2j8pF');
        $user->setEnabled(true);
        $user->addRole('ROLE_NATURALIST');
        $manager->persist($user);
        $manager->flush();

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        //$user = new User();
        $user->setEmail('user@user.com');
        $user->setUsername('user');
        $user->setPlainPassword('f76Q8Gzq');
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
        return 25;
    }

}
