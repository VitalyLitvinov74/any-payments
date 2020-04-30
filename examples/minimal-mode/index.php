<?php

use AnyPayments\examples\models\CardForm;
use AnyPayments\v3\psp\royalpay\RoyalPayPayment;

$payment =
    new Payment(
        new RoyalPayPayment(
            new CardForm($_POST)
        )
    );
$payment->pay();