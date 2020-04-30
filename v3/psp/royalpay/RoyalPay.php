<?php


namespace AnyPayments\v3\psp\royalpay;


use AnyPayments\v3\interfaces\ICardForm;
use AnyPayments\v3\interfaces\IHandlerNotification;
use AnyPayments\v3\interfaces\IHandlerPayment;
use AnyPayments\v3\interfaces\IPayment;
use AnyPayments\v3\interfaces\IRequestData;

/**
 * Parent class for  processor of a specific PSP
 * @property ICardForm $card
 */
class RoyalPay implements IRequestData, IHandlerNotification, IHandlerPayment
{
    private $card;

    public function __construct(ICardForm $card = null)
    {
        $this->card = $card;
    }

    /**
     * Generating action on handling notification from payment system
     */
    public function accept_notification(): void
    {
        // TODO: Implement accept_notification() method.
    }

    /**
     *  Generating action payment to payment system
     */
    public function pay(): void
    {
        // TODO: Implement pay() method.
    }

    /**
     * @return array|string|int|float - fields from request as it is
     */
    public function fields()
    {
        // TODO: Implement fields() method.
    }

    /**
     * @return array|string|int|float - headers from request as it is
     */
    public function headers()
    {
        // TODO: Implement headers() method.
    }
}