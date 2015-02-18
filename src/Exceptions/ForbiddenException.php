<?php

namespace Rutube\Exceptions;

/**
 * Class ForbiddenException
 * @package Rutube\Exceptions
 */
class ForbiddenException extends Exception
{
    /**
     * @var string
     */
    public $message = 'Forbidden';
    /**
     * @var int
     */
    public $code    = 403;
}