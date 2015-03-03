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

use Rutube\Transports\DefaultTransport as Transport;

/**
 * Базовый класс
 *
 * @package Rutube
 */
abstract class Entity
{
    /**
     * Транспорт выполнения запроса к API
     *
     * @var Transport
     */
    protected $transport;

    /**
     * Инициализация транспорта
     *
     * @param Transport $transport
     */
    public function __construct(Transport $transport)
    {
        $this->setTransport($transport);
    }

    /**
     * Возвращает текущий транспорт
     *
     * @return Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Устанавливает транспорт
     *
     * @param mixed $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }
}