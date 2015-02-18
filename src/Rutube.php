<?php

namespace Rutube;

/**
 * Class Rutube
 * @package Rutube
 */
class Rutube
{
    /**
     * @var Transport
     */
    protected $transport;
    /**
     * @var bool
     */
    protected $secure = false;

    /**
     * @param null $username
     * @param null $password
     * @param bool $secure
     * @param string $host
     * @param string $transport
     */
    public function __construct($username = null, $password = null, $secure = true, $host = 'rutube.ru', $transport = 'httpful')
    {
        $this->secure = $secure;
        /** @var \Httpful\Request transport */
        $this->transport = new Transport($transport, $secure, $host);

        if ($username && $password) {
            $this->transport->authorize($username, $password);
        }
    }

    /**
     * @return bool
     */
    public function isAuthorized()
    {
        return $this->transport->hasToken();
    }

    /**
     * @return mixed
     */
    public function isSecure()
    {
        return $this->transport->isSecure();
    }


    /**
     * @return Video
     */
    public function video()
    {
        return new Video($this->getTransport());
    }

    /**
     *
     */
    public function account()
    {
        return new Account($this->getTransport());
    }

    /**
     * @return Search
     */
    public function search()
    {
        return new Search($this->getTransport());
    }

    /**
     *
     */
    public function raw()
    {

    }

    /**
     * @return Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }
}