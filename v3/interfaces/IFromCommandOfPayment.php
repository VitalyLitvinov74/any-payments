<?php


namespace AnyPayments\v3\interfaces;


interface IFromCommandOfPayment
{
    /**
     * тип данных в котором будут передаваться поля.
     * @return string = json|url|xml
     */
    public function output_fields_type(): string;

    /**
     * Заголовки которые будут отправлены при создании транзакции.
     */
    public function headers(): array;

    /**
     * Поля которые будут отправлены при создании транзакции
     */
    public function fields(): array;

    /**
     * Урл на который будут отправляться запросы.
     */
    public function api_url(): string;

    /**
     * перенаправляет пользователя после получения ответа от psp
     *
     * @param $response - поля которые пришли от psp
     */
    public function redirect($response): void;

    /**
     * Возвращает id транзакции на нашей стороне.
     */
    public function transaction_id():string;

    /**
     * Возвращает данные формы
     */
    public function card(): ICardForm;
}
