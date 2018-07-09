<?php

namespace App\Tests\Services;

use App\Services\BadgeManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class AbstractBadges extends TestCase
{
    /**
     * Instance of OrderManager Service
     * @return BadgeManager
     */
    protected function getBadgeManagerInstance()
    {
        $em = $this->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var EntityManagerInterface $em */
        $badgeManager = new BadgeManager($em);
        return $badgeManager;
    }
}
