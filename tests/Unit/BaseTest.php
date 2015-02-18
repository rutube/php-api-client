<?php

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
        extract($params);

        return $video->upload($url, $title, $description, $categoryId);
    }
}