<?php
require_once '../vendor/autoload.php';

//with a ready-made solution
/*$payment = PaymentSystem::readyMade('RoyalPay',
    [
        'public_key' => '',
        'secret_key' => '',
        'notification_url'=>'index.php' //for two page solution: notification-page.php
    ])->pay();
$payment->accept_notification(); //one page solution*/


$payment =
    new PaymentSystem(
        new Royalpay(
            new CardForm($_POST)
        )
    );

?>

<form method="POST">
    <input name="amount" placeholder="200" value="200">
    <select name="currency">
        <option>USD</option>
        <option>EUR</option>
        <option>RUB</option>
        <option>UAH</option>
    </select>
    <input name="psp" type="hidden" value="Royalpay">
</form>
