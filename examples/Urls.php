<?php


namespace AnyPayments\examples;


use AnyPayments\v3\interfaces\IUrl;

/**
 * @property string $domain
 */
class Urls implements IUrl
{
    private $domain;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function callback_url(array $params = []): string
    {
        return $this->domain . '/simple/notificationPage.php';
    }

    public function after_payment_url(array $params = []): string
    {
        return $this->domain . '/simple/successPage.php';
    }

    public function success_url(array $params = []): string
    {
        return $this->domain . '/simple/successPage.php';
    }

    public function fail_url(array $params = []): string
    {
        if (isset($params['message'])) {
            return $this->domain . '/simple/errorPage?message=' . $params['message'];
        }
        return $this->domain . '/simple/errorPage';
    }
}