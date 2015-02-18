<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// Загрузить типы ТВ шоу
$tvTypes = $rutube->search()->loadTvTypes(1393);

print_r($tvTypes);