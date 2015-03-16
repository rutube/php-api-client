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
 * Interface ClientInterface
 * @package Rutube\Clients
 */
interface ClientInterface
{
    /**
     * Запрос GET
     * @param string $uri
     * @return mixed
     */
    public function get($uri);

    /**
     * Заропс PUT
     * @param string $uri
     * @return mixed
     */
    public function put($uri);

    /**
     * Запрос DELETE
     * @param string $uri
     * @return mixed
     */
    public function delete($uri);

    /**
     * Запрос POST
     * @param string $uri
     * @return mixed
     */
    public function post($uri);

    /**
     * Запрос PATCH
     * @param $uri
     * @return mixed
     */
    public function patch($uri);

    /**
     * Установка заголовков для корректной работы с Rutube
     * @param string $token
     * @return mixed
     */
    public function setHeaders($token);

    /**
     * Тело запроса
     * @param array $body
     * @return mixed
     */
    public function setBody($body);

    /**
     * Отсылка файла через POST-запрос
     * @param array $files
     * @return mixed
     */
    public function attach(array $files);

    /**
     * Выполнение запроса
     * @return mixed
     */
    public function send();

    /**
     * Установка User-Agent
     * @param string $userAgent
     * @return mixed
     */
    public function setUserAgent($userAgent);

    /**
     * Установка клиентского IP-адреса
     * @param string $ip
     * @return mixed
     */
    public function setXRealIP($ip);
}