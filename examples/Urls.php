<?php


namespace AnyPayments\examples;


use AnyPayments\v3\interfaces\IUrl;

class Urls implements IUrl
{
    public function callback_url(array $params = []): string
    {
        // TODO: Implement callback_url() method.
    }

    public function after_payment_url(array $params = []): string
    {
        // TODO: Implement after_payment_url() method.
    }

    public function success_url(array $params = []): string
    {
        // TODO: Implement success_url() method.
    }

    public function fail_url(array $params = []): string
    {
        // TODO: Implement fail_url() method.
    }
}