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
class DefaultTransport
{
    /**
     * @var \Httpful\Request
     */
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
    protected $token;

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
     * @param string $username
     * @param string $password
     * @return $this
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function authorize($username, $password)
    {
        $response = $this->call('POST', 'api/accounts/token_auth/', array('username' => $username, 'password' => $password));

        $this->token = $response->token;

        return $this;
    }

    /**
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadVideoPerson(array $query)
    {
        return $this->call('GET', 'api/video/person/', array(), $query);
    }

    /**
     * @param int $id
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadVideoPersonById($id, array $query)
    {
        return $this->call('GET', 'api/video/person/' . $id . '/', array(), $query);
    }

    /**
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadTags()
    {
        return $this->call('GET', 'api/tags/');
    }

    /**
     * @param int $id
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadVideoTags($id, array $query)
    {
        return $this->call('GET', 'api/tags/video/' . $id . '/', array(), $query);
    }

    /**
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoTv(array $query)
    {
        return $this->call('GET', 'api/metainfo/tv/', array(), $query);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoTvContentTypes($id)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/contenttvstype/');
    }


    /**
     * @param string $id
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoTvSeasons($id)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/season/');
    }

    /**
     * @param string $id
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoTvVideos($id, array $query)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/video/', array(), $query);
    }

    /**
     * @param string $id
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoTvLastEpisode($id, $query)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/last_episode/', array(), $query);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadMetainfoContenttvs($id)
    {
        return $this->call('GET', 'api/metainfo/contenttvs/' . $id . '/');
    }

    /**
     * @param string $id
     * @param array $query
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function getVideoPlayOptions($id, array $query)
    {
        return $this->call('GET', 'api/play/options/' . $id . '/', array(), $query);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function uploadVideo(array $params)
    {
        return $this->call('POST', 'api/video/', $params);
    }

    /**
     * @param string $id
     * @return bool
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function deleteVideo($id)
    {
        return $this->call('DELETE', 'api/video/' . $id, array(), array(), array(), true) == 204;
    }

    /**
     * @param string $id
     * @param array $params
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function putVideo($id, $params)
    {
        return $this->call('PUT', 'api/video/' . $id . '/', $params);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function getVideo($id)
    {
        return $this->call('GET', 'api/video/' . $id . '/');
    }

    /**
     * @param string $id
     * @param array $params
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function patchVideo($id, $params)
    {
        return $this->call('PATCH', 'api/video/' . $id, $params);
    }

    /**
     * @param string $id
     * @param array $file
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function addThumb($id, array $file)
    {
        return $this->call('POST', 'api/video/' . $id . '/thumbnail/', array(), array(), $file);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function publication($params)
    {
        return $this->call('POST', 'api/video/publication/', $params);
    }

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
     * @param bool $return_code Если true - вместо текста ответа возвращается HTTP-код ответа
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
                ->asJson();

            if ($this->getToken()) {
                $request = $request->setHeaders($this->getToken());
            }

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