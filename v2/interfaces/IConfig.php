<?php


namespace AnyPayments\interfaces;


interface IConfig
{
    /**
     * Возвращает настройки базы данных.
    */
    public function db(): array;

    /**
     * содержит ключи, для готовых подключений к платежным системам.
    */
    public function payment_system_keys(): array;
}