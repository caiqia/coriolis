<?php

namespace LUCIE\RadiusBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RadControllerTest extends WebTestCase
{
    /**
     * @dataProvider getTables
     */
    public function testCounts($url)
    {
        $urlToCall = $this->defaultUrl() . "count/" . $url;

        $client = self::createClient();
        $crawler = $client->request('GET', $urlToCall);

        var_dump($client->getResponse()->getStatusCode());

        
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertTrue($client->getResponse()->headers->contains('Content-type', 'application/json'));
    }

    public function defaultUrl()
    {
        return "/api/v1/users/";
    }

    public function getTables()
    {
        return array(
            array("check"),
            array("reply"),
            array("groupcheck"),
            array("groupreply"),
            array("usergroup"),
        );
    }
}
