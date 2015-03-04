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
 *
 * @method mixed loadVideoPerson(array $query)
 * @method mixed loadVideoPersonById($id, array $query)
 * @method mixed loadTags()
 * @method mixed loadVideoTags($id, array $query)
 * @method mixed loadMetainfoTv(array $query)
 * @method mixed loadMetainfoTvContentTypes($id)
 * @method mixed loadMetainfoTvSeasons($id)
 * @method mixed loadMetainfoTvVideos($id, array $query)
 * @method mixed loadMetainfoTvLastEpisode($id, $query)
 * @method mixed loadMetainfoContenttvs($id)
 * @method mixed uploadVideo(array $params)
 * @method mixed putVideo($id, $params)
 * @method mixed getVideo($id)
 * @method mixed patchVideo($id, $params)
 * @method mixed addThumb($id, array $file)
 * @method mixed publication($params)
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
     * @var array
     */
    protected $transports = [
        'httpful' => '\Rutube\Clients\ClientHttpful',
    ];

    /**
     * Карта маппинга простых методов на API Rutube
     * @var array
     */
    protected $map = [
        'loadVideoPerson' => ['params' => 'GET;query', 'url' => 'api/video/person/'],
        'loadVideoPersonById' => ['params' => 'GET;id;query', 'url' => 'api/video/person/{id}/'],
        'loadTags' => ['params' => 'GET', 'url' => 'api/tags/'],
        'loadVideoTags' => ['params' => 'GET;id;query', 'url' => 'api/tags/video/{id}/'],
        'loadMetainfoTv' => ['params' => 'GET;query', 'url' => 'api/metainfo/tv/'],
        'loadMetainfoTvContentTypes' => ['params' => 'GET;id', 'url' => 'api/metainfo/tv/{id}/contenttvstype/'],
        'loadMetainfoTvSeasons' => ['params' => 'GET;id', 'url' => 'api/metainfo/tv/{id}/season/'],
        'loadMetainfoTvVideos' => ['params' => 'GET;id;query', 'url' => 'api/metainfo/tv/{id}/video/'],
        'loadMetainfoTvLastEpisode' => ['params' => 'GET;id;query', 'url' => 'api/metainfo/tv/{id}/last_episode/'],
        'loadMetainfoContenttvs' => ['params' => 'GET;id', 'url' => 'api/metainfo/contenttvs/{id}/'],
        'uploadVideo' => ['params' => 'POST;params', 'url' => 'api/video/'],
        'putVideo' => ['params' => 'PUT;id;params', 'url' => 'api/video/{id}/'],
        'getVideo' => ['params' => 'GET;id', 'url' => 'api/video/{id}/'],
        'patchVideo' => ['params' => 'PATCH;id;params', 'url' => 'api/video/{id}/'],
        'addThumb' => ['params' => 'POST;id;file', 'url' => 'api/video/{id}/thumbnail/'],
        'publication' => ['params' => 'POST;params', 'url' => 'api/video/publication/'],
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
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Rutube\Exceptions\ConnectionErrorException
     * @codeCoverageIgnore
     */
    public function __call($name, $arguments)
    {
        if (isset($this->map[$name])) {
            $args = explode(';', $this->map[$name]['params']);
            $i = 0;
            $method = $args[0];
            $id = '';
            $params = [];
            $query = [];
            $file = [];

            for ($j = 1; $j < sizeof($args); $j++) {
                ${$args[$j]} = $arguments[$i];
                $i++;
            }

            $url = ($id !== '') ? str_replace('{id}', $id, $this->map[$name]['url']) : $this->map[$name]['url'];

            return $this->call($method, $url, $params, $query, $file);

        }
    }

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
     * @param $id
     * @return bool
     */
    public function deleteVideo($id)
    {
        return $this->call('DELETE', 'api/video/' . $id, [], [], [], true) == 204;
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