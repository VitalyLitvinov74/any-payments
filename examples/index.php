<?php

use AnyPayemtns\v3\psp\royalpay\RoyalPayNotification;
use AnyPayemtns\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\examples\Credential;
use AnyPayments\v3\Config;
use AnyPayments\v3\handlers\NotificationOf;
use AnyPayments\v3\handlers\PaymentOf;

$config =
    [
        'db' => [
            'db_host' => '', //with db
            'db_name' => '', //with db
            'username' => '', //with db
            'password' => '', //with db
            'db_type' => 'mysql' //with db
        ],
        'urls' => [ //or use IUrls
            'callback_url' => '',//default
            'after_payment_url' => '', //default
            'fail_url' => '', //default
            'success_url' => '', //default
        ]
    ];
$payment =
    new PaymentOf( //новый платеж
        new RoyalPayPayment( //роялпэй
            new CardForm( //форма, обрабатывающая карту
                $_POST
            ),
            $credentials = new Credential([ //данные авторизации для роялпэй.
                'secret_key'=>'',
                'public_key' => ''
            ])
        ),
        $config['db']
    );


$notification =
    new NotificationOf(
        new RoyalPayNotification(
            $credentials
        ),
        $config['db']
    );