<?php

include_once('BaseTest.php');
/**
 * Class FinderTest
 */
class RutubeTest extends BaseTest
{
    /**
     *
     */
    public function testVideo()
    {
        $r = new \Rutube\Rutube();

        $this->assertInstanceOf('\Rutube\Video', $r->video());
    }

    public function testSearch()
    {
        $r = new \Rutube\Rutube();

        $this->assertInstanceOf('\Rutube\Search', $r->search());
    }

    public function testAccount()
    {
        $r = new \Rutube\Rutube();

        $this->assertInstanceOf('\Rutube\Account', $r->account());
    }

    public function testTransport()
    {
        $r = new \Rutube\Rutube();

        $this->assertInstanceOf('\Rutube\Transport', $r->getTransport());
    }

    public function testRaw()
    {

    }

}