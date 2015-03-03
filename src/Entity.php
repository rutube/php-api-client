<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube;

/**
 * Abstract Class Entity
 * @package Rutube
 */
abstract class Entity
{
    /**
     * @var \Rutube\Transport
     */
    protected $transport;

    /**
     * @param Transport $transport
     */
    public function __construct(Transport $transport)
    {
        $this->setTransport($transport);
    }

    /**
     * @return \Rutube\Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param mixed $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }
}