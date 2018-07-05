<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{

    /**
     * Functional Test of register on the website with forgotten password on first submit form
     */
    public function testRegisterPage()
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $link = $crawler->filter('div#globalNavbar a.btn.btn-reg-h')->link();

        $crawler = $client->click($link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Créer un compte')->form();

        $form['fos_user_registration_form[email]'] = 'test@gmail.com';
        $form['fos_user_registration_form[username]'] = 'christopher02';
        $form['fos_user_registration_form[plainPassword][first]'] = '';
        $form['fos_user_registration_form[plainPassword][second]'] = 'test';

        $crawler = $client->submit($form);

        $this->assertFalse($client->getResponse()->isRedirect());

        $form['fos_user_registration_form[email]'] = 'test@gmail.com';
        $form['fos_user_registration_form[username]'] = 'christopher02';
        $form['fos_user_registration_form[plainPassword][first]'] = 'test';
        $form['fos_user_registration_form[plainPassword][second]'] = 'test';

        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('html:contains("Confirmer votre inscription")')->count());

        $this->assertTrue($client->getResponse()->isSuccessful());

        echo $client->getResponse()->getContent();

    }

}
