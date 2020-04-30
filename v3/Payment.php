<?php


namespace AnyPayments\v3;


use AnyPayments\v3\interfaces\IHandlerPayment;
use AnyPayments\v3\interfaces\IPayment;
/**
 * @property IPayment $psp;
*/
class Payment implements IHandlerPayment
{
    private $psp;

    public function __construct(IPayment $psp) {
        $this->psp = $psp;
    }

    /**
     *  Generating action payment to payment system
     */
    public function pay(): void
    {

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