<?php

use AnyPayemtns\v3\psp\royalpay\RoyalPayNotification;
use AnyPayemtns\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\v3\Config;
use AnyPayments\v3\handlers\NotificationOf;
use AnyPayments\v3\handlers\PaymentOf;

$config = new Config(
    [
        'secret' => [
            'secret_key' => '',
            'auth_key' => '',
        ],
        'db' => [
            'db_host' => '',
            'db_name' => '',
            'username' => '',
            'password' => '',
            'db_type' => 'mysql'
        ],
        'urls'=>[
            'callback_url'=>'',//default
            'after_payment_url'=>'', //default
            'fail_url'=>'', //default
            'success_url'=>'', //default
        ]
    ]
);

$payment =
    new PaymentOf(
        new RoyalPayPayment(
            new CardForm(
                $_POST
            )
        )
    );

$notification =
    new NotificationOf(
        new RoyalPayNotification(
        )
    );