<?php

use Rutube\Exceptions;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Авторизация
 **/
try {
    $rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);

    echo "Авторизован: " . ($rutube->isAuthorized() ? "да" : "нет") . "\n"; // result: true/false
    echo "Соединение:  " . ($rutube->isSecure() ? "https" : "http") . "\n"; // Возвращает тип соединения. В случае https - true; в случае http - false

} catch (Exceptions\ConnectionErrorException $ex) {
    echo "ConnectionErrorException: Ошибка доступа к Rutube\n";
} catch (Exceptions\BadRequestException $ex) {
    echo "BadRequestException: Некорректные параметры авторизации\n";
}