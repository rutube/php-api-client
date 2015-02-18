<?php

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
    public $message = 'Not found';
    /**
     * @var int
     */
    public $code    = 404;
}