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
     * @var string|null Пользовательский User-Agent
     */
    protected $userAgent = null;

    /**
     * @var string|null Передавать в заголовке X-Real-IP указанный IP-адрес
     */
    protected $x_real_ip = null;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Запрос GET
     * @param string $uri
     * @return mixed
     */
    public function get($uri)
    {
        $this->request = Request::get($uri);

        return $this;
    }

    /**
     * Запрос POST
     * @param string $uri
     * @return mixed
     */
    public function post($uri)
    {
        $this->request = Request::post($uri);

        return $this;
    }

    /**
     * Заропс PUT
     * @param string $uri
     * @return mixed
     */
    public function put($uri)
    {
        $this->request = Request::put($uri);

        return $this;
    }

    /**
     * Запрос DELETE
     * @param string $uri
     * @return mixed
     */
    public function delete($uri)
    {
        $this->request = Request::delete($uri);

        return $this;
    }

    /**
     * Запрос PATCH
     * @param $uri
     * @return mixed
     */
    public function patch($uri)
    {
        $this->request = Request::patch($uri);

        return $this;
    }

    /**
     * Установка заголовков для корректной работы с Rutube
     * @param string $token
     * @return mixed
     */
    public function setHeaders($token = null)
    {
        $headers = array(
            'Accept' => 'application/json',
            'User-Agent' => 'Rutube_PHPClient',
        );

        if ($token !== null) {
            $headers['Authorization'] = 'Token ' . $token;
        }

        $this->request->addHeaders($headers);

        return $this;
    }

    /**
     * Тело запроса
     * @param array $body
     * @return mixed
     */
    public function setBody($body)
    {
        $this->request->body($body);

        return $this;
    }

    /**
     * Выполнение запроса
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
     * Выставление заголовка принятия ответа в формате Json
     * @return $this
     */
    public function asJson()
    {
        $this->request->sendsJson();

        return $this;
    }

    /**
     * Отсылка файла через POST-запрос
     * @param array $files
     * @return mixed
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
     * Установка клиентского IP-адреса
     * @param string $ip
     * @return mixed
     */
    public function setXRealIP($ip)
    {
        $this->x_real_ip = $ip;

        return $this;
    }
}
