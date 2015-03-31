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

/**
 * Низкоуровневое обращение к API
 *
 * @package Rutube\Transports
 */
class DefaultTransport extends Transport
{
    /**
     * @param string $username
     * @param string $password
     * @return $this
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function authorize($username, $password)
    {
        $response = $this->call(
            'POST',
            'api/accounts/token_auth/',
            array('username' => $username, 'password' => $password)
        );

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
     * @param array $query
     * @throws \Rutube\Exceptions\ConnectionErrorException
     */
    public function loadTags(array $query)
    {
        return $this->call('GET', 'api/tags/', array(), $query);
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
}
