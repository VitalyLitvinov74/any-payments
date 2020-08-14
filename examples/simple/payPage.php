<?php

use AnyPayments\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\examples\Credential;
use AnyPayments\examples\Urls;
use AnyPayments\v3\handlers\PaymentOf;
include_once ('..\..\vendor\autoload.php');
/**
 * 1. скопируйте код ниже.
 * 2. заполните классы Urls, CardForm, Credential - в них нет ничего сложного.
 * 3. используйте.
 */
include_once ('..\config.php'); //это нужно закоментировать (если вы не используете файл конфигурации).
echo'<pre>';
if($_POST):
    $payment =
        new PaymentOf( //новый платеж
            new RoyalPayPayment( //роялпэй
                new CardForm( //форма, обрабатывающая карту
                    $_POST
                ),
                new Credential([ //данные авторизации для роялпэй.
                                 'secret_key' => $config['psp']['public_key'],
                                 'auth' => $config['psp']['auth']
                ]),
                new Urls($_SERVER['HTTP_HOST']) //содержит информацию о том куда перенаправлять пользователя.
            ),
            $config['db']
        );
    $payment->pay();
else:?>

<form method="post">
    <input type="text" placeholder="amount" name="amount">
    <select name="currency">
        <option value="USD">USD</option>
        <option value="RUB" selected>RUB</option>
        <option value="EUR">EUR</option>
    </select>
    <input value="1234" hidden name="user_id">
    <input type="submit" value="Оплатить">
</form>

<?php endif;
