<?php

require_once __DIR__ . '/../vendor/autoload.php';
/**
 * Авторизация
 **/
$rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

echo "Авторизован: " . $rutube->isAuthorized()."\n"; //result: true/false
echo "Защищенное:  " . $rutube->isSecure()."\n";     // Возвращает тип соединения. В случае https - true; в случае http - false