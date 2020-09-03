<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
use AnyPayments\v3\interfaces\IStream;
/**
 * Поток данных
 * @property IData $fields
 * @property IData $headers
*/
class StreamOfDataFrom implements IStream
{
    private $fields;
    private $headers;

    public function __construct(IData $fields, IData $headers)
    {
        $this->fields = $fields;
        $this->headers = $headers;
    }

    /**
     * отправляет содержимое на сервер платежной системы
     * @param IData $header - заголовки
     * @param IData $fields - поля
     * @return IStream
     */
    public function send(IData $header, IData $fields): IStream
    {
        return $this;
    }

    /**
     * читает ответ от платежной системы.
     * @return string
     * @throws \Exception
     */
    public function read_body(): string
    {
        return json_encode($this->fields->content());
    }

    /**
     * читает заголовки ответа
     * @return string
     */
    public function read_headers(): array
    {
        return $this->headers->content();
    }
}
