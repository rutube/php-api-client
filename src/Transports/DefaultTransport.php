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
 * Class Transport
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
     * @var \Rutube\Rutube
     */
    protected $rutube;
    /**
     * @var string
     */
    protected $token;
    /**
     * @var array
     */
    protected $exceptions = [
        400 => 'Rutube\Exceptions\BadRequestException',
        401 => 'Rutube\Exceptions\UnauthorizedException',
        403 => 'Rutube\Exceptions\ForbiddenException',
        404 => 'Rutube\Exceptions\NotFoundException',
        405 => 'Rutube\Exceptions\MethodNotAllowedException',
        500 => 'Rutube\Exceptions\ServerErrorException'
    ];

    /**
     * @param $transport
     * @param $secure
     * @param $rutube
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
    protected $transports = [
        'httpful' => '\Rutube\Clients\ClientHttpful',
    ];


    /**
     * @param $username
     * @param $password
     * @return $this
     */
    public function authorize($username, $password)
    {
        $response = $this->call('POST', 'api/accounts/token_auth/', ['username' => $username, 'password' => $password]);

        $this->token = $response->token;

        return $this;
    }

    /**
     * @param array $query
     * @return mixed
     */
    public function loadVideoPerson(array $query)
    {
        return $this->call('GET', 'api/video/person/', [], $query);
    }

    /**
     * @param $id
     * @param array $query
     * @return mixed
     */
    public function loadVideoPersonById($id, array $query)
    {
        return $this->call('GET', 'api/video/person/' . $id . '/', [], $query);
    }

    /**
     * @return mixed
     */
    public function loadTags()
    {
        return $this->call('GET', 'api/tags/');
    }

    /**
     * @param $id
     * @param $query
     * @return mixed
     */
    public function loadVideoTags($id, array $query)
    {
        return $this->call('GET', 'api/tags/video/' . $id . '/', [], $query);
    }

    /**
     * @param array $query
     * @return mixed
     */
    public function loadMetainfoTv(array $query)
    {
        return $this->call('GET', 'api/metainfo/tv/', [], $query);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoTvContentTypes($id)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/contenttvstype/');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoTvSeasons($id)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/season/');
    }

    /**
     * @param $id
     * @param array $query
     * @return mixed
     */
    public function loadMetainfoTvVideos($id, array $query)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/video/', [], $query);
    }

    /**
     * @param $id
     * @param $query
     * @return mixed
     */
    public function loadMetainfoTvLastEpisode($id, $query)
    {
        return $this->call('GET', 'api/metainfo/tv/' . $id . '/last_episode/', [], $query);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoContenttvs($id)
    {
        return $this->call('GET', 'api/metainfo/contenttvs/' . $id . '/');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function uploadVideo(array $params)
    {
        return $this->call('POST', 'api/video/', $params);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteVideo($id)
    {
        return $this->call('DELETE', 'api/video/' . $id, [], [], [], true) == 204;
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     */
    public function putVideo($id, $params)
    {
        return $this->call('PUT', 'api/video/' . $id . '/', $params);
    }

    /**
     * @param $id
     * @return bool
     */
    public function getVideo($id)
    {
        return $this->call('GET', 'api/video/' . $id . '/');
    }

    /**
     * @param $id
     * @param $params
     * @return bool
     */
    public function patchVideo($id, $params)
    {
        return $this->call('PATCH', 'api/video/' . $id, $params);
    }

    /**
     * @param $id
     * @param $file
     * @return mixed
     */
    public function addThumb($id, array $file)
    {
        return $this->call('POST', 'api/video/' . $id . '/thumbnail/', [], [], $file);
    }

    /**
     * @param $params
     * @return mixed
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
     * @param $url
     * @param array $query
     * @return string
     */
    protected function getUrl($url, $query = [])
    {
        $url = $this->getProtocol() . $this->rutube . '/' . $url;

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param $method
     * @param $url
     * @param array $params
     * @param array $query
     * @param array $file
     * @param bool $return_code
     * @return mixed
     * @throws Exceptions\ConnectionErrorException
     */
    public function call($method, $url, $params = [], $query = [], $file = [], $return_code = false)
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