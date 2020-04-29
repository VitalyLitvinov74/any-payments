<?php


namespace paymentsmulti\library\interfaces;


interface NotificationHandler
{

    public function psp();

    public function answer();

    public function fields(): array;

    public function headers(): array;
}