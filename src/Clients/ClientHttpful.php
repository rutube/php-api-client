<?php

namespace Rutube\Clients;

use Httpful\Request;

/**
 * Class ClientHttpful
 * @package Rutube\Clients
 */
class ClientHttpful implements ClientInterface
{
    /** @var  Request */
    public $request;

    /**
     * @param $uri
     * @return $this
     */
    public function get($uri)
    {
        $this->request = Request::get($uri);

        return $this;
    }

    /**
     * @param $uri
     * @return $this
     */
    public function post($uri)
    {
        $this->request = Request::post($uri);

        return $this;
    }

    /**
     * @param $uri
     * @return $this
     */
    public function put($uri)
    {
        $this->request = Request::put($uri);

        return $this;
    }

    /**
     * @param $uri
     * @return $this
     */
    public function delete($uri)
    {
        $this->request = Request::delete($uri);

        return $this;
    }

    public function patch($uri)
    {
        $this->request = Request::patch($uri);

        return $this;
    }

    /**
     * @param $token
     * @return $this
     */
    public function setHeaders($token = null)
    {
        $headers = [
            'Accept'        => 'application/json',
            'User-Agent'    => '',
        ];

        if ($token) {
            $headers['Authorization'] = 'Token ' . $token;
        }

        $this->request->addHeaders($headers);

        return $this;
    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->request->body($body);

        return $this;
    }

    /**
     * @return \Httpful\associative|string
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function send()
    {
        return $this->request->send();
    }

    /**
     * @return $this
     */
    public function asJson()
    {
        $this->request->sendsJson();

        return $this;
    }

    public function attach(array $files)
    {
        $this->request->attach($files);

        return $this;
    }
}