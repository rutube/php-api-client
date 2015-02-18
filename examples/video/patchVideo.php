<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

// загрузить свои видео
$video = $rutube->video()->upload('http://dl.dropboxusercontent.com/u/17497896/27808763b94d4e479e6ed98fe9e54ec2.mp4', 'title', 'description', 1,13);

// обновить видео
$v = $video->patchVideo($data->video_id, 'Новое описание', 'Название', 0, 11);

print_r($v);