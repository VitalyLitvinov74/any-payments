<?php

use AnyPayments\v3\psp\royalpay\RoyalPayNotification;
use AnyPayments\examples\Credential;
use AnyPayments\v3\handlers\NotificationOf;
/**
 * 1. скопируйте код ниже.
 * 2. заполните классы Urls, CardForm, Credential - в них нет ничего сложного.
 * 3. используйте.
 */
$config =
    [
        'db' => [
            'db_host' => '', //with db
            'db_name' => '', //with db
            'username' => '', //with db
            'password' => '', //with db
            'db_type' => 'mysql' //with db
        ]
    ];

$notification =
    new NotificationOf(
        new RoyalPayNotification(
            new Credential([
                'secret_key'=>'your secret key',
                'auth_key' => 'your auth key'
            ])
        ),
        $config['db']
    );