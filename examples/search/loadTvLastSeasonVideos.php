<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить видео последнего сезона ТВ шоу
$tvLastSeasonVideo = $rutube->search()->loadTvLastSeasonVideos(1393);

print_r($tvLastSeasonVideo);