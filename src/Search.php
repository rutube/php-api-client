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
 * Поиск через API Rutube
 *
 * @package Rutube
 */
class Search extends Entity
{
    /**
     * Получение списка собственных роликов
     *
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadVideoPerson($page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoPerson(array('page' => $page, 'limit' => $limit));
    }

    /**
     * Получение публичного списка роликов пользователя
     *
     * @param int $id ID пользователя
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadVideoPersonById($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoPersonById($id, array('page' => $page, 'limit' => $limit));
    }

    /**
     * Загрузка справочника тегов
     *
     * @return mixed
     */
    public function loadTags()
    {
        return $this->getTransport()->loadTags();
    }

    /**
     * Получение списка роликов по тегу
     *
     * @param int $id ID тега
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadVideoTags($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadVideoTags($id, array('page' => $page, 'limit' => $limit));
    }

    /**
     * Получение списка доступных ТВ-шоу
     *
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadTv($page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTv(array('page' => $page, 'limit' => $limit));
    }

    /**
     * Получение списка возможных типов контента для ТВ-шоу
     *
     * @param string $id ID ТВ-шоу
     * @return mixed
     */
    public function loadTvTypes($id)
    {
        return $this->getTransport()->loadMetainfoTvContentTypes($id);
    }

    /**
     * Получение списка сезонов для указанного ТВ-шоу
     *
     * @param string $id ID ТВ-шоу
     * @return mixed
     */
    public function loadTvSeasons($id)
    {
        return $this->getTransport()->loadMetainfoTvSeasons($id);
    }

    /**
     * Получение списка роликов для указанного ТВ-шоу
     *
     * @param string $id ID ТВ-шоу
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadTvVideos($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTvVideos($id, array('page' => $page, 'limit' => $limit));
    }

    /**
     * Получение списка роликов для ТВ-шоу для последнего сезона
     *
     * @param string $id ID ТВ-шоу
     * @param int $page Страница
     * @param int $limit Кол-во результатов на странице
     * @return mixed
     */
    public function loadTvLastSeasonVideos($id, $page = 1, $limit = 20)
    {
        return $this->getTransport()->loadMetainfoTvLastEpisode($id, array('page' => $page, 'limit' => $limit));
    }

    /**
     * Получение информации о связях видео с ТВ-шоу
     *
     * @param string $id ID эпизода
     * @return mixed
     */
    public function loadTvVideoRelations($id)
    {
        return $this->getTransport()->loadMetainfoContenttvs($id);
    }
}
