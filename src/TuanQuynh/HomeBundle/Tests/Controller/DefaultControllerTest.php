<?php
namespace TuanQuynh\HomeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
  public function testIndex()
  {
    $client = static ::createClient();

    //$crawler = $client->request('GET', '/hello/Fabien');
    //$this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    $crawler = $client->request('GET', '/');
    $response = $client->getResponse();

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertGreaterThan(0, $crawler->filter('body:contains("Hello Tuan Quynh!")')->count());
  }
}
