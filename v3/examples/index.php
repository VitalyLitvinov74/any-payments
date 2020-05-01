<?php
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
        new RoyalpayNotification()
    );