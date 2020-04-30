<?php


namespace AnyPayments\v3\psp;

use AnyPayments\v3\interfaces\IHandlerPayment;
use AnyPayments\v3\interfaces\INotification;
use AnyPayments\v3\interfaces\IPayment;
use AnyPayments\v3\psp\royalpay\RoyalPay;
use AnyPayments\v3\psp\royalpay\RoyalPayNotification;
use AnyPayments\v3\psp\royalpay\RoyalPayPayment;

/**
 * this class is needed only for automatic detection of the payment system. those.
 * choosing a payment strategy.
 * @property string $payment_system_name
 * @property array $config;
 * @property IHandlerPayment $payment
 */
class PaymentStrategy
{
    private $payment_system_name;
    private $payment;

    public function __construct(string $payment_system_name)
    {
        $this->payment_system_name = strtolower($payment_system_name);
    }

    public function payment_system(): string{
        if (is_null($this->payment)){
            $config = $this->config;
            switch ($this->payment_system_name) {
                default:
                    $payment = NullPayment::class;
                    break;
                case 'royalpay':
                    $payment = RoyalPay::class;
                    break;
            }
            $this->payment = $payment;
        }
        return $this->payment;
    }
}