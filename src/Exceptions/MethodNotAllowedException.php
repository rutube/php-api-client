<?php

namespace Rutube\Exceptions;

/**
 * Class MethodNotAllowedException
 * @package Rutube\Exceptions
 */
class MethodNotAllowedException extends Exception
{
    /**
     * @var string
     */
    public $message = 'Method Not Allowed';
    /**
     * @var int
     */
    public $code    = 405;
}