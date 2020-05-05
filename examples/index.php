<?php


use AnyPayemtns\v3\psp\royalpay\RoyalPayNotification;
use AnyPayemtns\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\examples\Urls;
use AnyPayments\v3\handlers\NotificationOf;
use AnyPayments\v3\handlers\PaymentOf;

$payment =
    new PaymentOf(
        new RoyalPayPayment(
            new CardForm(
                $_POST
            ),
            new Urls()
        )
    );

$notification =
    new NotificationOf(
        new RoyalpayNotification()
    );