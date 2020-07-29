<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;

/**
 * @property IFromCommandOfPayment $psp
 * @property array $db_connection
 */
class PaymentOf implements IHandlerOfPayment
{
    private $psp;
    private $db_connection;

    public function __construct(IFromCommandOfPayment $psp, array $db_connection)
    {
        $this->psp = $psp;
    }

    public function pay(): void
    {

    }
}