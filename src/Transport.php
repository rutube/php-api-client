<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube;

/**
 * Class TransportFactory
 * @package Rutube
 */
use Rutube\Exceptions\Exception;

/**
 * Class Transport
 * @package Rutube
 */
class Transport
{
    /**
     * @var \Rutube\Transport
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
        $response = $this->client
            ->post($this->getUrl('api/accounts/token_auth/'))
            ->asJson()
            ->setBody(['username' => $username, 'password' => $password])
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        $this->token = $response->body->token;

        return $this;
    }

    /**
     * @param array $query
     * @return mixed
     */
    public function loadVideoPerson(array $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/video/person/', $query))
            ->asJson()
            ->setHeaders($this->getToken())
            ->send();


        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param array $query
     * @return mixed
     */
    public function loadVideoPersonById($id, array $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/video/person/' . $id . '/', $query))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @return mixed
     */
    public function loadTags()
    {
        $response = $this->client
            ->get($this->getUrl('api/tags/'))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param $query
     * @return mixed
     */
    public function loadVideoTags($id, array $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/tags/video/' . $id . '/', $query))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param array $query
     * @return mixed
     */
    public function loadMetainfoTv(array $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/tv/', $query))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoTvContentTypes($id)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/tv/' . $id . '/contenttvstype/'))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoTvSeasons($id)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/tv/' . $id . '/season/'))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param array $query
     * @return mixed
     */
    public function loadMetainfoTvVideos($id, array $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/tv/' . $id . '/video/', $query))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param $query
     * @return mixed
     */
    public function loadMetainfoTvLastEpisode($id, $query)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/tv/' . $id . '/last_episode/', $query))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadMetainfoContenttvs($id)
    {
        $response = $this->client
            ->get($this->getUrl('api/metainfo/contenttvs/' . $id . '/'))
            ->asJson()
            ->setHeaders()
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function uploadVideo(array $params)
    {
        $response = $this->client
            ->post($this->getUrl('api/video/'))
            ->asJson()
            ->setHeaders($this->getToken())
            ->setBody($params)
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]($response->body, $response->meta_data['http_code']);
        }

        return $response->body;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteVideo($id)
    {
        $response = $this->client
            ->delete($this->getUrl('api/video/' . $id))
            ->setHeaders($this->getToken())
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->meta_data['http_code'] == 204;
    }

    /**
     * @param $id
     * @param $params
     * @return mixed
     */
    public function putVideo($id, $params)
    {
        $response = $this->client
            ->put($this->getUrl('api/video/' . $id . '/'))
            ->asJson()
            ->setHeaders($this->getToken())
            ->setBody($params)
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @return bool
     */
    public function getVideo($id)
    {
        $response = $this->client
            ->get($this->getUrl('api/video/' . $id . '/'))
            ->setHeaders($this->getToken())
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param $params
     * @return bool
     */
    public function patchVideo($id, $params)
    {
        $response = $this->client
            ->patch($this->getUrl('api/video/' . $id))
            ->asJson()
            ->setHeaders($this->getToken())
            ->setBody($params)
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $id
     * @param $file
     * @return mixed
     */
    public function addThumb($id, array $file)
    {
        $response = $this->client
            ->post($this->getUrl('api/video/' . $id . '/thumbnail/'))
            ->asJson()
            ->setHeaders($this->getToken())
            ->attach($file)
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function publication($params)
    {
        $response = $this->client
            ->post($this->getUrl('api/video/publication/'))
            ->asJson()
            ->setHeaders($this->getToken())
            ->setBody($params)
            ->send();

        if (isset($this->exceptions[$response->meta_data['http_code']])) {
            throw new $this->exceptions[$response->meta_data['http_code']]();
        }

        return $response->body;
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

        if ($query) {
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
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }
}