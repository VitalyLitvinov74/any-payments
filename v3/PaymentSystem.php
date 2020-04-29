<?php


namespace AnyPayments\v2;


use AnyPayments\v2\interfaces\IHandler;
use AnyPayments\v2\interfaces\INotification;
use AnyPayments\v2\interfaces\IPayment;
use AnyPayments\v2\psp\PaymentStrategy;
/**
 * @property IHandler $handler;
*/

class PaymentSystem implements IHandler
{

    private $switch = true; //if true - payment, else - notification
    private $handler;

    /**
     * @param IHandler $handler
     */
    public function __construct(IHandler $handler)//два типа данных.
    {
        $this->handler = $handler;
    }

    /**
     * for easy-mode
    */
//    public static function readyMade(string $payment_name, $config = []): self
//    {
//        $payment_name = new PaymentStrategy($payment_name);
//    }

    public function accept_notification(): void
    {
        $this->handler->accept_notification();
    }

    public function pay(): void
    {
        $this->handler->pay();
    }

    public function fields(): string
    {
        return $this->handler->fields();
    }

    public function headers(): string
    {
        return $this->handler->headers();
    }
}