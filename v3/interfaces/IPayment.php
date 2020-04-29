<?php


namespace AnyPayments\v2\interfaces;

interface IPayment extends ISettings
{
    /**
     * Принимает на вход форму карты.
     * преобразует эти данные и передает в psp через библеотеку payments.
     *
     * @param ICardForm $card
     */
    public function __construct(ICardForm $card);
}