<?php


namespace AnyPayments\examples\models;


use AnyPayments\v2\interfaces\ICardForm;

class CardForm implements ICardForm
{
    public function __construct(string $hello) {
        echo $hello;
    }
}