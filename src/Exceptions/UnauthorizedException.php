<?php

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