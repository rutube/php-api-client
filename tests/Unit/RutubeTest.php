<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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