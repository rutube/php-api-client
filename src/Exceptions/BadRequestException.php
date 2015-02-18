<?php

namespace Rutube\Exceptions;

/**
 * Class BadRequestException
 * @package Rutube\Exceptions
 */
class BadRequestException extends Exception
{
    /**
     * @var string
     */
    public $message = 'Bad Request';
    /**
     * @var int
     */
    public $code    = 400;
}