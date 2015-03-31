<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube\Transports;

use Rutube\Exceptions\Exception;

/**
 * Низкоуровневое обращение к API
 *
 * @package Rutube\Transports
 */
class Transport
{
    protected $client;

    /**
     * @var boolean
     */
    protected $secure;

    /**
     * @var string
     */
    protected $rutube;

    /**
     * @var string
     */
    protected $token = null;

    /**
     * @var array
     */
    protected $exceptions = array(
        400 => 'Rutube\Exceptions\BadRequestException',
        401 => 'Rutube\Exceptions\UnauthorizedException',
        403 => 'Rutube\Exceptions\ForbiddenException',
        404 => 'Rutube\Exceptions\NotFoundException',
        405 => 'Rutube\Exceptions\MethodNotAllowedException',
        500 => 'Rutube\Exceptions\ServerErrorException'
    );

    /**
     * @param string $transport
     * @param bool $secure
     * @param string $rutube
     * @throws Exception
     */
    public function __construct($transport, $secure, $rutube)
    {
        $this->secure = $secure;
        $this->rutube = $rutube;
        $trs = $this->transports;

        if (!isset($trs[$transport]) || !class_exists($trs[$transport])) {
            throw new Exception("Unknown " . $transport . " transport");
        }

        $this->client = new $trs[$transport]();
    }

    /**
     * @var array
     */
    protected $transports = array(
        'httpful' => '\Rutube\Clients\ClientHttpful',
        'mock' => '\Rutube\Clients\ClientMock',
    );

    /**
     * @return string
     */
    protected function getProtocol()
    {
        $protocol = 'http';

        if ($this->isSecure()) {
            $protocol .= 's';
        }

        return $protocol . "://";
    }

    /**
     * @param string $url
     * @param array $query
     * @return string
     */
    protected function getUrl($url, $query = array())
    {
        $url = $this->getProtocol() . $this->rutube . '/' . $url;

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return (bool)$this->secure;
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return (bool)$this->token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return \Httpful\Request
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $method Метод: GET, POST, PUT, PATCH, DELETE
     * @param string $url URL метода API, например: api/video/person/
     * @param array $params Параметры зпроса
     * @param array $query Запрос
     * @param array $file Путь к файлу
     * @param bool $return_code Если true - возвращается HTTP-код ответа
     * @return mixed
     *
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function call($method, $url, $params = array(), $query = array(), $file = array(), $return_code = false)
    {
        try {
            /** @var \Httpful\Request $request */
            $request = $this->client
                ->{strtolower($method)}($this->getUrl($url, $query))
                ->asJson()
                ->setHeaders($this->getToken());

            if (!empty($params)) {
                $request = $request->setBody($params);
            }

            if (!empty($file)) {
                $request = $request->attach($file);
            }

            $response = $request->send();
        } catch (\Exception $e) {
            throw new \Rutube\Exceptions\ConnectionErrorException($e->getMessage(), $e->getCode());
        }

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $return_code ? $response->meta_data['http_code'] : $response->body;
    }
}
