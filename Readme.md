Rutube PHP API Client
======================
[![Build Status](https://img.shields.io/travis/rutube/php-api-client/master.svg?style=flat-square)](https://travis-ci.org/rutube/php-api-client) 
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/rutube/php-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/rutube/php-api-client/?branch=master) 
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/rutube/php-api-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/rutube/php-api-client/?branch=master) 
[![Latest Stable Version](https://img.shields.io/packagist/v/rutube/php-api-client.svg?style=flat-square)](https://packagist.org/packages/rutube/php-api-client) 

## Установка
Установка через composer:

```sh
composer require "rutube/php-api-client: 1.0.*"
```

## Использование

```php
require 'vendor/autoload.php';

/**
 * Авторизация
 **/
Rutube\Rutube('login', 'password', /*secure*/ true);

$rutube->isAuthorized(); // result: true/false
$rutube->isSecure();     // Возвращает тип соединения. В случае https - true; в случае http - false


/**
 * Работа с видео
 **/

// Основные параметры:

$url        = 'url';
$title      = 'title';
$descr      = 'description';
$isHidden   = 0;
$categoryId = 13;

// Чтобы узнать о состоянии загружаемого видео после конвертации, нужно задать callback-урлы:
$callback_url = 'http://host.host/success'; // В случае успешной загрузки и конвертации видео в теле запроса будут переданы данные видео.
$errback_url  = 'http://host.host/error';   // В случае ошибки загрузки и конвертации в теле запроса будут сведения об ошибке.

// Получить объект видео:
$video  = $rutube->video();

// Загрузить видео. В ответе содержится video_id:
$data = $video->upload($url, $title, $descr, $isHidden, $categoryId, $callback_url, $errback_url);

// Обновить параметры видео (заголовок, описание, видимость и категорию):
$video->patchVideo($data->video_id, $title, $descr, $isHidden, $categoryId);

// Частично обновить параметры видео:
//  описание и категорию:
$video->patchVideo($data->video_id, null, $descr, null, $categoryId);
//  только заголовок:
$video->patchVideo($data->video_id, $title);

// Удалить видео:
$video->deleteVideo($data->video_id);

// Добавить обложку видео. $filename - полный путь до файла:
$video->addThumb($data->video_id, $filename);

// Отложить публикацию до времени:
$video->publication($data->video_id, '2015-01-16 20:36:31');

// Получить видео:
$video->getVideo($data->video_id);


/**
 * Работа с данными, не требующими авторизации
 **/

$search = $rutube->search();

// Показать список видео пользователя по его id:
$search->loadVideoPersonById($personId, $page = 1, $limit = 20);

// Показать теги:
$search->loadTags($page = 1, $limit = 20);

// Показать видео по тегу:
$search->loadVideoTags($tagId, $page = 1, $limit = 20);

// Показать тв-шоу:
$search->loadTv($page = 1, $limit = 20);

// Показать типы тв-шоу:
$search->loadTvTypes($tvShowId);

// Показать сезоны тв-шоу:
$search->loadTvSeasons($tvShowId);

// Показать видео тв-шоу:
$search->loadTvVideos($tvshowId, $page = 1, $limit = 20);

// Показать видео из последнего сезона тв-шоу:
$search->loadTvLastSeasonVideos($tvShowId, $page = 1, $limit = 20)

/**
 * Работа с данными, требующими авторизации
 **/

// Если авторизованы, показать список личных видео:
$search->loadVideoPerson($page = 1, $limit = 20);

```

## Обработка ошибок
Все ошибки передаются через Exceptions соответствующего класса.

| Код ответа | Класс Exception | Описание |
|:------------:|---------------------------|----------------------------------------------------------------------------|
|  | ConnectionErrorException | Сервер не доступен |
| 400 | BadRequestException | Переданы некорректные данные |
| 401 | UnauthorizedException | Требуется авторизация |
| 403 | ForbiddenException | Авторизованный пользователь не имеет прав на выполнение данного действия |
| 404 | NotFoundException | Сущность или ресурс не существуют (не доступны) |
| 405 | MethodNotAllowedException | Ресурс не поддерживает работу с используемым методом запроса |
| 500 | ServerErrorException | Во время выполнения запроса возникли ошибки на стороне сервера. Рекомендуется попробовать позднее или связаться со службой поддержки |

Пример авторизации с обработкой ошибок:
```php
try {
    $rutube = new \Rutube\Rutube('squirrel@squirrel.ru', '998800', /*secure*/ true);
} catch (Exceptions\ConnectionErrorException $ex) {
    echo "Сервер не доступен";
} catch (Exceptions\BadRequestException $ex) {
    echo "Некорректные параметры авторизации";
}
```

## Запуск юнит-тестов
Тесты написаны на phpunit.

Запустить тесты без установленного phpunit:
```bash
$ composer update
$ composer test
```

## Документация по API
[dev.rutube.ru](http://dev.rutube.ru/)

## Документация по библиотеке
[rutube.github.io/php-api-client](http://rutube.github.io/php-api-client/)
