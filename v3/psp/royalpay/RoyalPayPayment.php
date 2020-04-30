<?php


namespace AnyPayments\v3\psp\royalpay;


use AnyPayments\v3\interfaces\ICardForm;
use AnyPayments\v3\interfaces\IPayment;
use paymentsmulti\library\interfaces\CardInterface;
/**
 * @property ICardForm $card
*/
class RoyalPayPayment implements IPayment
{
    private $card;

    /**
     * Принимает на вход форму карты.
     * преобразует эти данные и передает в psp через библеотеку payments.
     * @param ICardForm $card
     */
    public function __construct(ICardForm $card)
    {
        $this->card = $card;
    }

    /**
     * тип данных в котором будут передаваться поля.
     * @return string = json|url|xml
     */
    public function output_fields_type(): string
    {
        // TODO: Implement output_fields_type() method.
    }

    /**
     * Заголовки которые будут отправлены при создании транзакции.
     */
    public function headers(): array
    {
        // TODO: Implement headers() method.
    }

    /**
     * Поля которые будут отправлены при создании транзакции
     */
    public function fields(): array
    {
        // TODO: Implement fields() method.
    }

    /**
     * Урл на который будут отправляться запросы.
     */
    public function api_url(): string
    {
        // TODO: Implement api_url() method.
    }

    /**
     * перенаправляет пользователя после получения ответа от psp
     * @param $response - поля которые пришли от psp
     */
    public function redirect($response): void
    {
        // TODO: Implement redirect() method.
    }

    /**
     * Возвращает id транзакции на нашей стороне.
     */
    public function transaction_id(): string
    {
        // TODO: Implement transaction_id() method.
    }

    /**
     * Возвращает данные формы для записи в бд.
     */
    public function card(): CardInterface
    {
        return $this->card;
    }
}