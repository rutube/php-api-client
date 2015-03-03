<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class BaseTest
 */
abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function defaultProvider()
    {
        return [[USER_LOGIN, USER_PASS, true, RUTUBE_HOST]];
    }

    public function defaultNotAuthProvider()
    {
        return ['', '', true, RUTUBE_HOST];
    }


    /**
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @return \Rutube\Rutube
     */
    protected function getRutube($username, $password, $secure, $host)
    {
        return new \Rutube\Rutube($username, $password, $secure, $host);
    }

    /**
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @return \Rutube\Video
     */
    protected function getRutubeVideo($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);

        return $rutube->video();
    }

    /**
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @return \Rutube\Search
     */
    protected function getRutubeSearch($username, $password, $secure, $host)
    {
        $rutube = $this->getRutube($username, $password, $secure, $host);

        return $rutube->search();
    }

    /**
     * @param \Rutube\Video $video
     * @param $params
     * @return mixed
     */
    protected function getUploadVideo(\Rutube\Video $video, $params)
    {
        if (!isset($params['callback_url'])) $params['callback_url'] = null;
        if (!isset($params['errback_url'])) $params['errback_url'] = null;
        if (!isset($params['query_fields'])) $params['query_fields'] = null;
        if (!isset($params['extra'])) $params['extra'] = null;

        extract($params);

        return $video->upload($url, $title, $description, $isHidden, $categoryId, $callback_url, $errback_url, $query_fields, $extra);
    }
}