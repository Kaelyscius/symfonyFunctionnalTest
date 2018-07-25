<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class MyControllerTest extends PantherTestCase
{
//    public function testMyAction()
//    {
//        $client = static::createPantherClient();
//
//        $client->request('GET', '/');
//
//        $crawler = $client->getCrawler();
//
//        $client->takeScreenshot('screen.jpg');
//        sleep(5);
//
//        $this->assertContains(
//            'Symfony 4.1.2',
//            $client->getResponse()->getContent()
//        );
//
//        $this->assertEquals(1, $crawler->filter('h1')->count());
//    }
//
//    public function testDocAction()
//    {
//        $client = static::createPantherClient();
//
//        $crawler = $client->request('GET', '/');
//        sleep(2);
//
//        $link = $crawler->selectLink('How to create your first page in Symfony')->link();
//        $crawler = $client->click($link);
//
//        sleep(2);
//        $this->assertEquals('Create your First Page in Symfony', $crawler->filter('h1')->text());
//    }

    public function testFormSuccessAction()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/dummy');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['form[email]'] = 'emailvalide@gmail.com';
        $form['form[name]'] = 'Toto';

        //sleep(2);

        $crawler = $client->submit($form);
        //sleep(2);
        $this->assertContains('Message envoyé', $crawler->filter('.success')->text());
    }

    public function testFormErrorAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/dummy');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['form[email]'] = 'emailnonvalide';
        $form['form[name]'] = 'Toto';

        //sleep(2);

        $client->enableProfiler();
        $crawler = $client->submit($form);
        $duration = $client->getProfile()->getCollector('time')->getDuration();
        sleep(2);
        $this->assertLessThanOrEqual(500, $duration);
        $this->assertContains('This value is not a valid email address.', $crawler->filter('ul > li')->text());
    }
}
