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
 * Class Raw
 * @package Rutube
 */
class Raw extends Entity
{
    /**
     * @param $method
     * @param $url
     * @param array $options ['params'=>[], 'query'=>[], 'file'=>[], 'return_code'=>false]
     * @return mixed
     */
    public function call($method, $url, $options = [])
    {
        return $this->getTransport()->call(
            $method,
            $url,
            isset($options['params']) ? $options['params'] : [],
            isset($options['query']) ? $options['query'] : [],
            isset($options['file']) ? $options['file'] : [],
            isset($options['return_code']) ? $options['return_code'] : false
        );
    }
}