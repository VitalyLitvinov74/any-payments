<?php

use AnyPayemtns\v3\psp\royalpay\RoyalPayNotification;
use AnyPayemtns\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\examples\Credential;
use AnyPayments\examples\Urls;
use AnyPayments\v3\handlers\NotificationOf;
use AnyPayments\v3\handlers\PaymentOf;

/**
 * 1. скопируйте код ниже.
 * 2. заполните классы Urls, CardForm, Credential - в них нет ничего сложного.
 * 3. используйте.
 */
$config =
    [
        'db' => [
            'db_host' => '', //require
            'db_name' => '', //require
            'username' => '', //require
            'password' => '', //require
            'db_type' => 'mysql', //require
        ]
    ];
$payment =
    new PaymentOf( //новый платеж
        new RoyalPayPayment( //роялпэй
            new CardForm( //форма, обрабатывающая карту
                $_POST
            ),
            new Credential([ //данные авторизации для роялпэй.
                             'secret_key' => 'your secret key',
                             'auth' => 'your auth key'
            ]),
            new Urls($_SERVER['REQUEST_URI']) //содержит информацию о том куда перенаправлять пользователя.
        ),
        $config['db']
    );
$payment->pay();