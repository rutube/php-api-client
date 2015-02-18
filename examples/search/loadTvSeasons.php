<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить Сезоны ТВ шоу
$tvSeasons = $rutube->search()->loadTvSeasons(1393);

print_r($tvSeasons);