<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube\Clients;

/**
 * Mock HTTP-клиент
 * @package Rutube\Clients
 */
class ClientMock implements ClientInterface
{
    /**
     * @var array
     */
    private static $queue = array();

    /**
     * @param string $uri
     * @return $this
     */
    public function get($uri)
    {
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function post($uri)
    {
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function put($uri)
    {
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function delete($uri)
    {
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function patch($uri)
    {
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setHeaders($token = null)
    {
        return $this;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function setBody($body)
    {
        return $this;
    }

    /**
     * @return \Httpful\associative|string
     *
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function send()
    {
        return self::$queue ? array_shift(self::$queue) : self::createMock();
    }

    /**
     * @return $this
     */
    public function asJson()
    {
        return $this;
    }

    /**
     * @param array $files
     * @return $this
     */
    public function attach(array $files)
    {
        return $this;
    }

    /**
     * @param array $params
     * @param int $http_code
     */
    public static function setMock(array $params = array(), $http_code = 200)
    {
        self::$queue[] = self::createMock($params, $http_code);
    }

    /**
     * @param array $params
     * @param int $http_code
     * @return \stdClass
     */
    private static function createMock(array $params = array(), $http_code = 200)
    {
        $obj = new \stdClass();
        $obj->body = new \stdClass();
        $obj->meta_data = array('http_code' => $http_code);

        foreach ($params as $key => $value) {
            $obj->body->{$key} = $value;
        }

        return $obj;
    }
}