<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

// загрузить свои видео
$data = $rutube->video()->upload('http://pic.rutube.ru/staticfile/27808763b94d4e479e6ed98fe9e54ec2.mp4', 'title', 'description', 1,13);

// Получить видео
$v = $rutube->video()->getVideo($data->video_id);

print_r($v);


