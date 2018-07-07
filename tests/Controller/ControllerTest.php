<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{

    /**
     * Test accessible pages with NOT connected User
     * @dataProvider urlProviderAccessiblePages
     * @param $url
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * All theses pages are redirected to connexion due to restricted permissions
     * Interface and Admin Routes
     * @dataProvider urlProviderInaccessiblePages
     * @param $url
     */
    public function testRedirectedPages($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isRedirection());
    }

    /**
     * All theses pages not exist and get notfound
     * Interface Routes
     * @dataProvider urlProviderNotFoundPages
     * @param $url
     */
    public function testNotFoundPages($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isNotFound());
    }


    // Provide list of all redirected pages with NOT connected User
    public function urlProviderInaccessiblePages()
    {
        return [
            ['/interface/'],
            ['/interface/observations/1'],
            ['/interface/observation/ajouter'],
            ['/interface/observation/carte'],
            ['/interface/classement'],
            ['/interface/mes-observations/1'],
            ['/interface/memory'],
            ['/interface/compte/edit'],
            ['/admin']
        ];
    }

    // Provide list of pages found with NOT connected User
    public function urlProviderAccessiblePages()
    {
        return [
            ['/'],
//            ['/observations'],
//            ['/association'],
            ['/connexion'],
            ['/inscription'],
            ['/conditions-generales'],
            ['/mentions-legales'],
            ['/foire-aux-questions'],
            ['/contact']
        ];
    }

    // Provide list of not found page
    public function urlProviderNotFoundPages()
    {
        return [
            ['/test'],
            ['/interface/test'],
        ];
    }
}
