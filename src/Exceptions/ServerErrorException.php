<?php

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