<?php
$db = [
    'db_name'=>'asd',
    'user'=>'root',
    'password'=>'',
    'host'=>'',
];
new PaymentSystem(
  new RoyalPay(
      new CardForm(
          $_POST
      )
  ),
  $db
);