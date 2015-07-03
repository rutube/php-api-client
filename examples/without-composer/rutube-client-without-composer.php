<?php

require("../../autoload.php");
require('./httpful-0.2.19.phar');

use Rutube\Exceptions;

/**
 * Авторизация
 **/
try {
    $rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/true);

    echo "Авторизован: " . ($rutube->isAuthorized() ? "да" : "нет") . "\n"; // result: true/false
    echo "Соединение:  " . ($rutube->isSecure() ? "https" : "http") . "\n"; // Возвращает тип соединения. В случае https - true; в случае http - false

    // загрузить все тэги
    $tags = $rutube->search()->loadTags();

    print_r($tags);
} catch (Exceptions\ConnectionErrorException $ex) {
    echo "ConnectionErrorException: Ошибка доступа к Rutube\n";
} catch (Exceptions\BadRequestException $ex) {
    echo "BadRequestException: Некорректные параметры авторизации\n";
}
