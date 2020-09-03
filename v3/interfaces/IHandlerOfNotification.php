<?php


namespace AnyPayments\v3\interfaces;


interface IHandlerOfNotification
{
    /**
     * @return IFromCommandOfNotification
    */
    public function psp();

    public function answer();

    public function fields(): array;

    public function headers(): array;
}
