<?php


namespace AnyPayments\v2\interfaces;


interface IHandler
{
    public function pay(): void;

    public function accept_notification(): void;

    public function fields();

    public function headers();
}