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
     * Пользовательский User-Agent
     * @var string|null
     */
    protected $userAgent = null;

    /**
     * Передавать в заголовке X-Real-IP указанный IP-адрес
     * @var string|null
     */
    protected $x_real_ip = null;

    /**
     * @var Request
     */
    protected $request;

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
            'User-Agent' => 'Rutube_PHPClient',
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
        if ($this->userAgent !== null) {
            $this->request->addHeader('User-Agent', $this->userAgent);
        }

        if ($this->x_real_ip !== null) {
            $this->request->addHeader('X-Real-IP', $this->x_real_ip);
        }

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

    /**
     * Устанавливает User-Agent для текущего запроса
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Устанавливает загловок X-Real-IP для текущего запроса
     * @param string $ip
     * @return $this
     */
    public function setXRealIP($ip)
    {
        $this->x_real_ip = $ip;

        return $this;
    }
}