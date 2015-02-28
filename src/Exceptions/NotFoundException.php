<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube\Exceptions;

/**
 * Class NotFoundException
 * @package Rutube\Exceptions
 */
class NotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Not found';
    /**
     * @var int
     */
    protected $code    = 404;
}