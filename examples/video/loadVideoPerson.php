<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

// загрузить свои видео
$videos = $rutube->search()->loadVideoPerson(1, 20);

print_r($videos);