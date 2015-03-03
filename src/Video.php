<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube;

/**
 * Работа с видео
 *
 * @package Rutube
 */
class Video extends Entity
{
    /**
     * Загрузка видео
     *
     * @param string $url URL по которому находится скачиваемый ролик
     * @param string $title Название
     * @param string $description Описание
     * @param int $is_hidden Признак видимости, 1 - ролик скрыт
     * @param int $category_id ID категории
     * @param string|null $callback_url URL, вызываемый по завершению обработки ролика
     * @param string|null $errback_url URL, вызываемый для сообщения об ошибке
     * @param string|null $query_fields Перечень возвращаемых полей
     * @param string|null $extra Дополнительные параметры для колбэков
     * @return mixed
     */
    public function upload($url, $title = '', $description = '', $is_hidden = 1, $category_id = 13, $callback_url = null, $errback_url = null, $query_fields = null, $extra = null)
    {
        $params = [
            'url' => $url,
            'title' => $title,
            'description' => $description,
            'is_hidden' => $is_hidden,
            'category_id' => $category_id,
        ];

        if ($callback_url !== null) {
            $params['callback_url'] = $callback_url;
        }

        if ($errback_url !== null) {
            $params['errback_url'] = $errback_url;
        }

        if ($query_fields !== null) {
            $params['query_fields'] = $query_fields;
        }

        if ($extra !== null) {
            $params['extra'] = $extra;
        }

        return $this->getTransport()->uploadVideo($params);
    }

    /**
     * Удаление ролика
     *
     * @param string $id ID ролика
     * @return mixed
     */
    public function deleteVideo($id)
    {
        return $this->getTransport()->deleteVideo($id);
    }

    /**
     * Получени информации о ролике
     *
     * @param string $id ID ролика
     * @return mixed
     */
    public function getVideo($id)
    {
        return $this->getTransport()->getVideo($id);
    }

    /**
     * Обновить информацию о ролике
     *
     * @param string $id ID ролика
     * @param string $title Название
     * @param string $description Описание
     * @param int $is_hidden Признак видимости, 1 - ролик скрыт
     * @param int $category_id ID категории
     * @return mixed
     */
    public function putVideo($id, $title, $description, $is_hidden, $category_id)
    {
        $params = [
            'title' => $title,
            'description' => $description,
            'is_hidden' => $is_hidden,
            'category' => $category_id
        ];

        return $this->getTransport()->putVideo($id, $params);
    }

    /**
     * Обновление только указанных полей в информации о ролике
     *
     * @param string $id ID ролика
     * @param string|null $title Название
     * @param string|null $description Описание
     * @param int|null $is_hidden Признак видимости, 1 - ролик скрыт
     * @param int|null $category_id ID категории
     * @return mixed
     */
    public function patchVideo($id, $title = null, $description = null, $is_hidden = null, $category_id = null)
    {
        $params = [];

        if (!is_null($title)) {
            $params['title'] = $title;
        }

        if (!is_null($description)) {
            $params['description'] = $description;
        }

        if (!is_null($is_hidden)) {
            $params['is_hidden'] = $is_hidden;
        }

        if (!is_null($category_id)) {
            $params['category'] = $category_id;
        }

        return $this->getTransport()->patchVideo($id, $params);
    }

    /**
     * Загрузка превью к ролику
     *
     * @param string $id ID ролика
     * @param string $filename Путь к файлу превью
     * @return mixed
     */
    public function addThumb($id, $filename)
    {
        $file = ['file' => $filename];
        return $this->getTransport()->addThumb($id, $file);
    }

    /**
     * Отложенная публикация ролика
     *
     * @param string $id ID ролика
     * @param string $date Дата в формате 'YYYY-MM-DD H:i:s', например: '2015-01-16 20:36:31'
     * @return mixed
     */
    public function publication($id, $date)
    {
        $params = [
            'video' => $id,
            'timestamp' => $date,
        ];

        return $this->getTransport()->publication($params);

    }
}