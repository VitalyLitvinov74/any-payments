<?php

require_once '../vendor/autoload.php';
//with a ready-made solution
$payment = PaymentSystem::readyMade(
    'RoyalPay',
    [
        'public_key' => '',
        'secret_key' => '',
        'notification_url' => 'index.php' //for two page solution: notification-page.php
    ],
    [
        'db_name' => 'asd',
        'user' => 'root',
        'password' => '',
        'host' => '',
    ] //or global variable ANY_PAYMENTS_DB
)->pay();
$payment->accept_notification(); //one page solution

?>

<form method="POST">
    <input name="amount" placeholder="200" value="200">
    <select name="currency">
        <option>USD</option>
        <option>EUR</option>
        <option>RUB</option>
        <option>UAH</option>
    </select>
    <input name="scenario" type="hidden" value="Royalpay">
    <input name="user_id" type="hidden" value="123">
</form>
