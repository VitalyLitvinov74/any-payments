<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\meedoo\Medoo;

/**
 * @property string $transaction_id;
 * @property bool $paid
 * @property string $psp_transaction_id;
 * @property int $user_id
 * @property string currency
 * @property float $amount
 */
class BillingOf
{
    private $transaction_id;
    private $paid;
    private $psp_transaction_id;
    private $user_id;
    private $amount;
    private $currency;

    public function __construct(
        string $transaction_id,
        bool $paid,
        int $user_id,
        float $amount,
        string $currency,
        string $psp_transaction_id = '')
    {
        $this->transaction_id = $transaction_id;
        $this->user_id = $user_id;
        $this->paid = $paid;
        $this->psp_transaction_id = $psp_transaction_id;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function New(Medoo $db, IFromCommandOfPayment $psp): self
    {
        $db->insert(
            'payments_billing',
            [
                'transaction_id' => $psp->transaction_id(),
                'paid' => false,
                'psp_transaction_id' => '',
                'user_id' => $psp->card()->user_id(),
                'amount' => $psp->card()->amount(),
                'currency' => $psp->card()->currency()
            ]);
        return new self(
            $psp->transaction_id(),
            false,
            $psp->card()->user_id(),
            $psp->card()->amount(),
            $psp->card()->currency()
        );
    }

    public static function Db(Medoo $db, string $tansaction_id)
    {

    }

    public function update(array $data = []): void
    {
        if (isset($data['transaction_id'])) {
            $this->transaction_id = $data['transaction_id'];
        }
        if(isset($data['paid'])){//
            $this->paid = $data['paid'];
        }
        if(isset($data['user_id'])){
            $this->user_id = $data['user_id'];
        }
        if(isset($data['amount'])){
            $this->amount = $data['amount'];
        }
        if(isset($data['currency'])){
            $this->currency = $data['currency'];
        }
        if(isset($data['psp_transaction_id'])){
            $this->psp_transaction_id = $data['psp_transaction_id'];
        }
    }

    public function transaction_id(): string
    {
        return $this->transaction_id;
    }

    public function paid(){
        return $this->paid;
    }

    public function amount(): float{
        return $this->amount;
    }

    public function currency(): string{
        return $this->currency;
    }

    public function psp_transaction_id():string {
        return $this->psp_transaction_id;
    }

    public function user_id():string {
        return $this->user_id;
    }
}