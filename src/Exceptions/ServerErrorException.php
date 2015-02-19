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
 * Class ServerErrorException
 * @package Rutube\Exceptions
 */
class ServerErrorException extends Exception
{
    /**
     * @var string
     */
    public $message = 'Server Error';
    /**
     * @var int
     */
    public $code    = 500;
}