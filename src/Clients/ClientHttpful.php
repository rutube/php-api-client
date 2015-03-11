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

use Httpful\Request;

/**
 * HTTP-клиент на основе Httpful
 * @package Rutube\Clients
 */
class ClientHttpful implements ClientInterface
{
    /**
     * Таймаут HTTP-запроса
     */
    const TIMEOUT = 60;

    /**
     * @var Request
     */
    public $request;

    /**
     * @param string $uri
     * @return $this
     */
    public function get($uri)
    {
        $this->request = Request::get($uri);

        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function post($uri)
    {
        $this->request = Request::post($uri);

        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function put($uri)
    {
        $this->request = Request::put($uri);

        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function delete($uri)
    {
        $this->request = Request::delete($uri);

        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function patch($uri)
    {
        $this->request = Request::patch($uri);

        return $this;
    }

    /**
     * @param $token
     * @return $this
     */
    public function setHeaders($token = null)
    {
        $headers = array(
            'Accept' => 'application/json',
            'User-Agent' => '',
        );

        if ($token) {
            $headers['Authorization'] = 'Token ' . $token;
        }

        $this->request->addHeaders($headers);

        return $this;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->request->body($body);

        return $this;
    }

    /**
     * @return \Httpful\associative|string
     *
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function send()
    {
        return $this->request->timeout(self::TIMEOUT)->send();
    }

    /**
     * @return $this
     */
    public function asJson()
    {
        $this->request->sendsJson();

        return $this;
    }

    /**
     * @param array $files
     * @return $this
     */
    public function attach(array $files)
    {
        $this->request->attach($files);

        return $this;
    }
}