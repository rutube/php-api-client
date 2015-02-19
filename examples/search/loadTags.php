<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

// загрузить все тэги
$tags = $rutube->search()->loadTags();

print_r($tags);