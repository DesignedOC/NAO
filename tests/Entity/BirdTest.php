<?php

namespace tests\Entity;

use App\Entity\Bird;
use App\Entity\Observation;
use PHPUnit\Framework\TestCase;

class BirdTest extends TestCase
{
    public function testBirdExist()
    {
        $observation = new Observation();
        $this->assertNull($observation->getBird());
    }
}