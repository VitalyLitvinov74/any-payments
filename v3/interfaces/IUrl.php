<?php


namespace AnyPayments\v3\interfaces;


interface IUrl
{
    public function fail_url(array $params = []): string;

    public function callback_url(array $params = []): string;

    public function after_payment_url(array $params = []): string;

    public function success_url(array $params = []): string;
}