<?php
include ('../../vendor/autoload.php');
use AnyPayments\v3\psp\royalpay\RoyalPayNotification;
use AnyPayments\v3\psp\royalpay\RoyalPayPayment;
use AnyPayments\examples\CardForm;
use AnyPayments\examples\Credential;
use AnyPayments\examples\Urls;
use AnyPayments\v3\handlers\PaymentOf;


/**
 * 1. скопируйте код ниже.
 * 2. заполните классы Urls, CardForm, Credential - в них нет ничего сложного.
 * 3. используйте.
 */
$config =
    [
        'db' => [
            'db_host' => 'localhost', //require
            'db_name' => 'any_payments', //require
            'username' => 'root', //require
            'password' => '', //require
            'db_type' => 'mysql', //require
        ]
    ];
if($_POST): //если форма отправлена - то обрабатываем транзакцию
$payment =
    new PaymentOf( //новый платеж
        new RoyalPayPayment( //роялпэй. как обработчик платежа.
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
else:
?>
<form method="POST">
    <input name="user_id" type="text" hidden value="222">
    <input name="amount"  type="text">
    <select name="currency">
        <option value="usd">usd</option>
        <option value="eur">eur</option>
        <option value="rub" selected>rub</option>
    </select>
    <input type="submit" value="Оплатить">
</form>
<?php
endif;