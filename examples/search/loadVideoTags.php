<?php

require_once __DIR__ . '/../../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube();

$tagsVideo = $rutube->search()->loadVideoTags(961, $page = 1, $limit = 20);

print_r($tagsVideo);