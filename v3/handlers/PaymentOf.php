<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;
/**
 * @property IFromCommandOfPayment $psp
*/
class PaymentOf implements IHandlerOfPayment
{
    private $psp;

    public function __construct(IFromCommandOfPayment $psp) {
        $this->psp = $psp;
    }
}