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
 * Class UnauthorizedException
 * @package Rutube\Exceptions
 */
class UnauthorizedException extends Exception
{
    /**
     * @var string
     */
    public $message = "HTTP 401 - Unauthorized";
    /**
     * @var int
     */
    public $code    = 401;
}