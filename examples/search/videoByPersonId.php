<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить список видео по id
$personVideos = $rutube->search()->loadVideoPersonById(12116, $page = 1, $limit = 20);

print_r($personVideos);