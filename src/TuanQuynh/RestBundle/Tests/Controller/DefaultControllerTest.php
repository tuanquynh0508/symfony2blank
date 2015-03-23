<?php
namespace TuanQuynh\RestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
  public function testGreetSuccessfully()
  {
    $client = static ::createClient();
    $client->request('GET', '/api/v1/greet/TuanQuynh.json');
    $response = $client->getResponse();
    $greet = json_decode($client->getResponse()->getContent(), true);

    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals('Hello TuanQuynh!', $greet['greet']);
  }
}
