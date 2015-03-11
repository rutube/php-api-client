<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube\Tests;

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

        $this->assertInstanceOf('\Rutube\Transports\DefaultTransport', $r->getTransport());
    }

    /**
     * @expectedException \Rutube\Exceptions\Exception
     */
    public function testFakeTransport()
    {
        new \Rutube\Transports\DefaultTransport('fake', true, new \Rutube\Rutube());
    }

    public function testRaw()
    {
        $r = new \Rutube\Rutube();

        $this->assertInstanceOf('\Rutube\Raw', $r->raw());
    }
}