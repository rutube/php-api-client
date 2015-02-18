<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить список ТВ шоу
$tvShows = $rutube->search()->loadTv();

print_r($tvShows);