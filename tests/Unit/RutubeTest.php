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

use Rutube\Clients\ClientHttpful;

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

    public function testUserAgent()
    {
        ClientHttpful::$userAgent = 'TestUserAgent';
        ClientHttpful::$x_real_ip = '127.0.0.1';

        $this->assertInstanceOf('\Rutube\Rutube', new \Rutube\Rutube(USER_LOGIN, USER_PASS));

        ClientHttpful::$userAgent = null;
    }
}