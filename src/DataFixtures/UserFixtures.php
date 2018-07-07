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
//        $src = __DIR__."/../Resources/doc/mydocument.pdf";

        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setUsername($this->firstnameData());
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    private function firstnameData()
    {
        return [
            'Christophe',
            'Bernard'
        ];
    }

}
