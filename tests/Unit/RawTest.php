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
 * Class RawTest
 */
class RawTest extends BaseTest
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
        $rutube = $this->getRutube($username, $password, $secure, $host);
        $list = $rutube->raw()->call('GET', 'api/video/person/', ['query' => ['page' => $page, 'limit' => $limit]]);

        $this->assertObjectHasAttribute('per_page', $list);
        $this->assertObjectHasAttribute('page', $list);
        $this->assertObjectHasAttribute('results', $list);

        $this->assertEquals($page, $list->page);
        $this->assertEquals($limit, $list->per_page);
    }
}