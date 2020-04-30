<?php


namespace AnyPayments\v3\interfaces;


interface IHandlerPayment extends IRequestData
{
    /**
     *  Generating action payment to payment system
     */
    public function pay(): void;
}