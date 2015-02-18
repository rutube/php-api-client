loadTvVideos

<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить видео для ТВ шоу
$tvVideos = $rutube->search()->loadTvVideos(1393);

print_r($tvVideos);