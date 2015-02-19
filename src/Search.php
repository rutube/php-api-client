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
 * Class Search
 * @package Rutube
 */
class Search extends Entity
{
    /**
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadVideoPerson($page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoPerson(['page'=> $page, 'limit' => $limit]);
    }

    /**
     * @param $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadVideoPersonById($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoPersonById($id, ['page'=> $page, 'limit' => $limit]);

    }

    /**
     * @return mixed
     */
    public function loadTags()
    {
        return $this->getTransport()->loadTags();
    }

    /**
     * @param $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadVideoTags($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoTags($id, ['page'=> $page, 'limit' => $limit]);

    }

    /**
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadTv($page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTv(['page'=> $page, 'limit' => $limit]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadTvTypes($id)
    {
        return $this->getTransport()->loadMetainfoTvContentTypes($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadTvSeasons($id)
    {
        return $this->getTransport()->loadMetainfoTvSeasons($id);
    }

    /**
     * @param $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadTvVideos($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTvVideos($id, ['page'=> $page, 'limit' => $limit]);
    }

    /**
     * @param $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function loadTvLastSeasonVideos($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTvLastEpisode($id, ['page'=> $page, 'limit' => $limit]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function loadTvVideoRelations($id)
    {
        return $this->getTransport()->loadMetainfoContenttvs($id);
    }
}