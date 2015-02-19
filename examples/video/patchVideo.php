<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

// объект видео
$video = $rutube->video();

// загрузить свои видео
$data = $video->upload('http://pic.rutube.ru/staticfile/27808763b94d4e479e6ed98fe9e54ec2.mp4', 'title', 'description', 1,13);

// обновить видео
$v = $video->patchVideo($data->video_id, 'Новое описание', 'Название', 0, 11);

print_r($v);