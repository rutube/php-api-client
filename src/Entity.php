<?php

namespace Rutube;

abstract class Entity
{
    protected $transport;

    public function __construct(Transport $transport)
    {
        $this->setTransport($transport);
    }

    /**
     * @return mixed
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