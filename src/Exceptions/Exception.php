<?php

namespace Rutube\Exceptions;

/**
 * Class Exception
 * @package Rutube\Exceptions
 */
class Exception extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        if (is_object($message)) {
            $message = (array)$message;
        }

        if (is_array($message)) {
            $message = json_encode($message);
        }

        parent::__construct($message, $code, $previous);
    }
}