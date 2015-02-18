Rutube PHP API Wrapper
======================

## Установка
Установка через composer:

```sh
composer require rutube/rutube
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

// Загрузить видео. В ответе содержатся track_id (deprecated) и video_id:
$data = $video->upload($url, $title, $description, $categoryId, $callback_url, $errback_url);

// Обновить параметры видео (описание, заголовок, видимость и категорию):
$video->patchVideo($data->video_id, $descr, $title, $isHidden, $categoryId);

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
$search->loadTags();

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

## Запуск юнит-тестов
Тесты написаны на phpunit.

Запустить тесты без установленного phpunit:
```bash
$ composer update
$ composer test
```
