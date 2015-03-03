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
 * Class Video
 * @package Rutube
 */
class Video extends Entity
{
    /**
     * @param $url
     * @param string $title
     * @param string $description
     * @param int $isHidden
     * @param int $category_id
     * @param null $callback_url
     * @param null $errback_url
     * @param null $query_fields
     * @param null $extra
     * @return mixed
     */
    public function upload($url, $title = '', $description = '', $isHidden = 1, $category_id = 13, $callback_url = null, $errback_url = null, $query_fields = null, $extra = null)
    {
        $params = [
            'url' => $url,
            'title' => $title,
            'description' => $description,
            'is_hidden' => $isHidden,
            'category_id' => $category_id,
        ];

        if ($callback_url) {
            $params['callback_url'] = $callback_url;
        }

        if ($errback_url) {
            $params['errback_url'] = $errback_url;
        }

        if ($query_fields) {
            $params['query_fields'] = $query_fields;
        }

        if ($extra) {
            $params['extra'] = $extra;
        }

        return $this->getTransport()->uploadVideo($params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteVideo($id)
    {
        return $this->getTransport()->deleteVideo($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVideo($id)
    {
        return $this->getTransport()->getVideo($id);
    }

    /**
     * @param $id
     * @param $description
     * @param $title
     * @param $is_hidden
     * @param $category
     * @return mixed
     */
    public function putVideo($id, $description, $title, $is_hidden, $category)
    {
        $params = [
            'description' => $description,
            'title'       => $title,
            'is_hidden'   => $is_hidden,
            'category'    => $category
        ];

        return $this->getTransport()->putVideo($id, $params);
    }

    /**
     * @param $id
     * @param $description
     * @param $title
     * @param $hidden
     * @param $category
     * @return mixed
     */
    public function patchVideo($id, $description = null, $title = null, $hidden = null, $category = null)
    {
        $params = [];

        if (!is_null($description)) {
            $params['description'] = $description;
        }

        if (!is_null($title)) {
            $params['title'] = $title;
        }

        if (!is_null($hidden)) {
            $params['is_hidden'] = $hidden;
        }

        if (!is_null($category)) {
            $params['category'] = $category;
        }

        return $this->getTransport()->patchVideo($id, $params);
    }

    /**
     * @param $filename
     * @param $id
     * @return mixed
     */
    public function addThumb($id, $filename)
    {
        $file = ['file' => $filename];
        return $this->getTransport()->addThumb($id, $file);
    }

    /**
     * @param $videoId
     * @param $timestamp - format '2015-01-16 20:36:31'
     * @return mixed
     */
    public function publication($videoId, $timestamp)
    {
        $params = [
            'video'     => $videoId,
            'timestamp' => $timestamp,
        ];

        return $this->getTransport()->publication($params);

    }
}