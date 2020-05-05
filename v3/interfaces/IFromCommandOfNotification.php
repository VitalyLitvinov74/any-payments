<?php


namespace AnyPayments\v3\interfaces;


interface IFromCommandOfNotification
{

    /**
     * @return array - Ответ, отправляемый psp, при успешной транзакции
     */
    public function answer(): array;

    /**
     * @return array - Ответ при провале
     */
    public function answer_error(): array;

    /**
     * @return bool Указывает успешно ли прошла транзакция на стороне psp
     */
    public function transaction_successful(array $fields): bool;

    /**
     * @return bool достоверность источника от которого пришел запрос
     * проверяет подпись запроса
     */
    public function validate_input_signature(array $headers, array $fields): bool;

    /**
     * @return string - Id транзакции на стороне psp
     */
    public function psp_transaction_id(array $fields): string;

    /**
     * @return string - Id транзакции но уже в нашей системе.
     */
    public function transaction_id(array $fields): string;

    /**
     * @return string - ответ от psp (человекочитаемый ответ)
     */
    public function message(array $fields): string;

    /**
     * @return float - сумма которая вернула psp
     */
    public function amount(array $fields): float;

}