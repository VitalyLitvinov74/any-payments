<?php


namespace AnyPayments\v3;


use AnyPayments\v3\interfaces\IHandlerPsp;

class PaymentSystem
{
    public static function readyMode(string $payment_system, array $config, $db = null) { }

    public static function customMode(IHandlerPsp $psp){

    }

    public static function minimalMode_payment(){

    }

    public static function minimalMode_notification(){

    }
}