<?php


namespace AnyPayments\v2\psp\royalpay;


use AnyPayments\examples\models\CardForm;
use AnyPayments\v2\interfaces\ICardForm;
use AnyPayments\v2\interfaces\IHandler;
use AnyPayments\v2\interfaces\IPayment;
/**
 * @property string $mode
*/
class RoyalPay implements IHandler
{
   public function __construct(ICardForm $card = null) {
       
   }
}