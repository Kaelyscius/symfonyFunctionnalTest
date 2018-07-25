<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MyControllerTest extends WebTestCase
{
    public function testMyAction()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $crawler = $client->getCrawler();
        $this->assertContains(
            'Symfony 4.1.2',
            $client->getResponse()->getContent()
        );

        $this->assertEquals(1, $crawler->filter('h1')->count());
    }
}
