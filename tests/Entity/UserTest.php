<?php

namespace App\Tests\Services;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test the months expected from the first signup $date to compare with the date of NOW
     * @dataProvider getDatesProvider
     * @param $monthExpected
     * @param $date
     */
    public function testMonthsFromDate($monthExpected, $date)
    {
        $user = new User();
        $date = $this->createDateFromFormat($date);
        $user->setDateFrom($date);

        $this->assertEquals($monthExpected, $user->getMonthsFromDate());
    }

    /**
     * IMPORTANT - You have to change the months to compare the date of
     * Provide month expected
     * The date of first signup
     */
    public function getDatesProvider()
    {
        return [
            [1, '06/06/2018'],
            [12, '29/06/2017'],
            [22, '07/08/2016'],
            [6, '03/01/2018'],
            [2, '01/05/2018'],
        ];
    }

    /**
     * Create DateTime from string
     * @param $date
     * @return bool|\DateTime
     */
    protected function createDateFromFormat($date)
    {
        return \DateTime::createFromFormat('d/m/Y', $date);
    }

}
