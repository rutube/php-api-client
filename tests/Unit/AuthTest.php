<?php

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
        return [
            [USER_LOGIN, USER_PASS, true, RUTUBE_HOST],
            [USER_LOGIN, USER_PASS, false, RUTUBE_HOST],
        ];
    }

    /**
     * @return array
     */
    public function connectionErrorExceptionProvider()
    {
        return [
            [USER_LOGIN, USER_PASS, false, 'teststie.testzone'],
            [USER_LOGIN, USER_PASS, true, 'teststie.testzone'],

        ];
    }

    /**
     * @return array
     */
    public function badRequestExceptionProvider()
    {
        return [
            [$this->username, 'asdjalkj', false, RUTUBE_HOST],
            [$this->username, 'asdas', true, RUTUBE_HOST],
            ['asdad', 'asdas', false, RUTUBE_HOST],
            ['asdad', 'asdas', true, RUTUBE_HOST],
            ['aasdasd', $this->password, false, RUTUBE_HOST],
            ['aasdasd', $this->password, true, RUTUBE_HOST],
        ];
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
     * @dataProvider connectionErrorExceptionProvider
     * @expectedException \Httpful\Exception\ConnectionErrorException
     */
    public function testConnectionErrorExceptionAuth($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);
    }

    /**
     * @dataProvider badRequestExceptionProvider
     * @expectedException \Rutube\Exceptions\BadRequestException
     */
    public function testBadRequestExceptionAuth($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);
    }
}
