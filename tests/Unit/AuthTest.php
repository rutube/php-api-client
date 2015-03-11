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
class AuthTest extends BaseTest
{
    public $username = 'bbzaeqehherg@dropmail.me';
    public $password = 'yB2mtjS';

    /**
     * @return array
     */
    public function authProvider()
    {
        return array(
            array(USER_LOGIN, USER_PASS, true, RUTUBE_HOST),
            array(USER_LOGIN, USER_PASS, false, RUTUBE_HOST),
        );
    }

    /**
     * @return array
     */
    public function connectionErrorExceptionProvider()
    {
        return array(
            array(USER_LOGIN, USER_PASS, false, 'teststie.testzone'),
            array(USER_LOGIN, USER_PASS, true, 'teststie.testzone'),
        );
    }

    /**
     * @return array
     */
    public function badRequestExceptionProvider()
    {
        return array(
            array($this->username, 'asdjalkj', false, RUTUBE_HOST),
            array($this->username, 'asdas', true, RUTUBE_HOST),
            array('asdad', 'asdas', false, RUTUBE_HOST),
            array('asdad', 'asdas', true, RUTUBE_HOST),
            array('aasdasd', $this->password, false, RUTUBE_HOST),
            array('aasdasd', $this->password, true, RUTUBE_HOST),
        );
    }

    /**
     * @dataProvider authProvider
     */
    public function testAuth($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);

        $this->assertTrue($rutube->isAuthorized());
        $this->assertEquals($secure, $rutube->isSecure());
    }

    /**
     * @group slow
     * @dataProvider connectionErrorExceptionProvider
     * @expectedException \Rutube\Exceptions\ConnectionErrorException
     */
    public function testConnectionErrorExceptionAuth($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);
    }

    /**
     * @group slow
     * @dataProvider badRequestExceptionProvider
     * @expectedException \Rutube\Exceptions\BadRequestException
     */
    public function testBadRequestExceptionAuth($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);
    }
}
