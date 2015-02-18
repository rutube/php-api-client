<?php

namespace Rutube\Clients;

interface ClientInterface
{
    public function get($uri);
    public function put($uri);
    public function delete($uri);
    public function post($uri);
    public function patch($uri);
    public function setHeaders($headers);
    public function setBody($body);
    public function attach(array $files);
    public function send();
}