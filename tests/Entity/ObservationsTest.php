<?php

namespace tests\Entity;

use App\Entity\Bird;
use App\Entity\Observation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class ObservationsTest extends WebTestCase
{
    /**
     * @param $latitude
     * @param $longitude
     * @param $description
     * @param $lbNom
     * @param $nomVern
     */
    public function testObservations()
    {

        $observation = new Observation();
        $observation->setLatitude('48.862725');
        $observation->setLongitude('2.287592');
        $observation->setDescription('Observation');
        $bird = new Bird();
        $bird->setLbNom('Accipiter bicolor');
        $bird->setNomVern('Epervier bicolore');
       // $observation->setBird($bird);
        $user = new User();
        $user->setFirstname('Stephanie');
       // $observation->setUser(50);
       // $observation->setBirdName('Pic vert, Pivert');
        $this->assertEquals('48.862725', $observation->getLatitude());
        $this->assertEquals('2.287592', $observation->getLongitude());
        $this->assertEquals('Observation', $observation->getDescription());
        $this->assertEquals('Accipiter bicolor', $bird->getLbNom());
        $this->assertEquals('Epervier bicolore', $bird->getNomVern());
        $this->assertEquals('Stephanie', $user->getFirstname());
       // $this->assertEquals(50, $observation->getUser());
       // $this->assertEquals('Accipiter bicolor, Epervier bicolore', $observation->getBird());

    }

}