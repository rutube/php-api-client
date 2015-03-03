<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include_once('BaseTest.php');
/**
 * Class SearchTest
 */
class SearchTest extends BaseTest
{
    /**
     * @return array
     */
    public function paginationProvider()
    {
        $credentials = $this->defaultProvider();

        return [
            array_merge($credentials[0], [1, 1]),
            array_merge($credentials[0], [1, 2]),
            array_merge($credentials[0], [2, 1]),
        ];
    }

    public function paginationTagProvider()
    {
        $credentials = $this->defaultProvider();

        return [
            array_merge($credentials[0], [2270, 1, 20]),
            array_merge($credentials[0], [2270, 1, 30]),
            array_merge($credentials[0], [2270, 2, 40]),
        ];
    }

    public function paginationProfileProvider()
    {
        $credentials = $this->defaultProvider();

        return [
            array_merge($credentials[0], [683751, 1, 20]),
            array_merge($credentials[0], [683751, 1, 30]),
            array_merge($credentials[0], [683751, 2, 40]),
        ];
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadVideoPerson($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadVideoPerson($page, $limit);

        $this->assertEquals($page, $list->page);
        $this->assertEquals($limit, $list->per_page);
    }

    /**
     * @dataProvider paginationProfileProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadVideoPersonById($username, $password, $secure, $host, $personId, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadVideoPersonById($personId, $page, $limit);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);
    }

    /**
     * @group slow
     * @dataProvider defaultProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     */
    public function testLoadTags($username, $password, $secure, $host)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTags();

        $this->assertTrue(is_array($list));
        $this->assertGreaterThan(0, count($list));
    }

    /**
     * @dataProvider paginationTagProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $tag
     * @param $page
     * @param $limit
     */
    public function testLoadVideoTags($username, $password, $secure, $host, $tag, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadVideoTags($tag, $page, $limit);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);

        $this->assertEquals($page, $list->page);
        $this->assertEquals($limit, $list->per_page);
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTv($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);

        $this->assertEquals($page, $list->page);
        $this->assertEquals($limit, $list->per_page);
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTvTypes($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $tvShow = current($list->results)->id;

        $list = $search->loadTvTypes($tvShow);

        $this->assertTrue(is_array($list));
        $this->assertGreaterThan(0, count($list));
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTvSeasons($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $tvShow = current($list->results)->id;

        $list = $search->loadTvSeasons($tvShow);

        $this->assertTrue(is_array($list));
        $this->assertGreaterThan(0, count($list));
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTvVideos($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $tvShow = current($list->results)->id;

        $list = $search->loadTvVideos($tvShow, $page, $limit);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTvLastSeasonVideos($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $tvShow = current($list->results)->id;

        $list = $search->loadTvLastSeasonVideos($tvShow, $page, $limit);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);
    }

    /**
     * @dataProvider paginationProvider
     *
     * @param $username
     * @param $password
     * @param $secure
     * @param $host
     * @param $page
     * @param $limit
     */
    public function testLoadTvVideoRelations($username, $password, $secure, $host, $page, $limit)
    {
        $search = $this->getRutubeSearch($username, $password, $secure, $host);

        $list = $search->loadTv($page, $limit);

        $tvShow = current($list->results)->id;

        $list = $search->loadTvVideos($tvShow, $page, $limit);

        $episode = current($list->results)->id;

        $list = $search->loadTvVideoRelations($episode);

        $this->assertObjectHasAttribute('video_id', $list);
        $this->assertObjectHasAttribute('track_id', $list);

    }
}