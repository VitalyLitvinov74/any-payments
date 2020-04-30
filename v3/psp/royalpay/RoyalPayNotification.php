<?php


namespace AnyPayments\v3\psp\royalpay;


use AnyPayments\interfaces\INotification;

class RoyalPayNotification implements INotification
{

    /**
     * @return array - Ответ, отправляемый psp, при успешной транзакции
     */
    public function answer(): array
    {
        // TODO: Implement answer() method.
    }

    /**
     * @return array - Ответ при провале
     */
    public function answer_error(): array
    {
        // TODO: Implement answer_error() method.
    }

    /**
     * @return bool Указывает успешно ли прошла транзакция на стороне psp
     */
    public function transaction_successful(array $fields): bool
    {
        // TODO: Implement transaction_successful() method.
    }

    /**
     * @return bool достоверность источника от которого пришел запрос
     * проверяет подпись запроса
     */
    public function validate_input_signature(array $headers, array $fields): bool
    {
        // TODO: Implement validate_input_signature() method.
    }

    /**
     * @return string - Id транзакции на стороне psp
     */
    public function psp_transaction_id(array $fields): string
    {
        // TODO: Implement psp_transaction_id() method.
    }

    /**
     * @return string - Id транзакции но уже в нашей системе.
     */
    public function transaction_id(array $fields): string
    {
        // TODO: Implement transaction_id() method.
    }

    /**
     * @return string - ответ от psp (человекочитаемый ответ)
     */
    public function message(array $fields): string
    {
        // TODO: Implement message() method.
    }

    /**
     * @return float - сумма которая вернула psp
     */
    public function amount(array $fields): float
    {
        // TODO: Implement amount() method.
    }
}