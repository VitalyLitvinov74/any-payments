<?php


namespace AnyPayments\v3\interfaces;


interface IStream
{
    /**
     * отправляет содержимое на сервер платежной системы
     * @param IData $header - заголовки
     * @param IData $fields - поля
     * @return IStream
     */
    public function send(IData $header, IData $fields): self;

    /**
     * читает ответ от платежной системы.
     * @return string
     * @throws \Exception
    */
    public function read_body(): string;

    /**
     * читает заголовки ответа
     * @return string
    */
    public function read_headers(): array;
}
