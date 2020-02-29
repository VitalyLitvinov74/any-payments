<?php


namespace payment_library\resources;


use paymentsmulti\common\ExternalStaticData;
use paymentsmulti\common\tables\PaymentsBilling;
use payment_library\connectors\Medoo;
use payment_library\interfaces\NotificationHandler;
use payment_library\interfaces\NotificationInterface;
use payment_library\interfaces\IPayment;
use payment_library\resources\request\PspToServer;
use ReflectionClass;

/**
 * @property NotificationInterface $psp
 * @property Medoo $medoo
 * @property string $answer
 * @property bool $has_error
 * @property PaymentsBilling $billing
 * @property PspToServer $request
 */
class Notification implements NotificationHandler
{
    use PreparationData;
    private $fields;
    private $headers;
    private $psp;
    private $medoo;
    private $answer;
    private $has_error;
    private $billing;
    private $request;

    public function __construct(NotificationInterface $callback_psp)
    {
        $this->request = new PspToServer();
        $this->medoo = new Medoo();
        $this->log($this->headers(), $this->fields());
        $this->psp = $callback_psp;
        if ($callback_psp->transaction_id($this->fields())){
            //если такой вообще нет - то движение по алгоритму дальше не пойдет.
            $this->billing = PaymentsBilling::find()
                ->where([
                    'transaction_id'=>$callback_psp->transaction_id($this->fields())
                ])
                ->one();
            $this->enjoy();
        }
    }

    public function psp()
    {
        return $this->psp;
    }

    private function enjoy()
    {
        $fields = $this->fields;
        $headers = $this->headers;
        $psp = $this->psp;
        if ($psp->validate_input_signature($this->headers(), $this->fields())) {
            if ($psp->transaction_successful($this->fields()) and $this->updated_billing()) {
                $this->has_error = false;
            } else {
                $this->has_error = true;
            }
            $this->answer = $psp->answer();
        } else {
            $this->answer = $psp->answer_error(); //если валидация не пройдена - то и в бд нечего писать
            $this->has_error = true;
        }
    }

    private function log($header, $response)
    {
        $this->medoo->insert('payments_logger', [
            'headers' => json_encode($header),
            'fields' => json_encode($response)
        ]);
    }

    private function updated_billing(): bool
    {
        $trans_id = $this->psp->transaction_id($this->fields());
        $record = $this->medoo->select('payments_billing', 'id',
            ['transaction_id' => $trans_id, 'paid' => false]);
        if (!empty($record)) { //если запись есть то все ок.
            $this->medoo->update('payments_billing',
                [
                    'paid' => true,
                    'psp_transaction_id' => $this->psp->transaction_id($this->fields()),
                ],
                [
                    'transaction_id' => $this->psp->transaction_id($this->fields())
                ]);
            return true;
        }
        return false;
    }

    public function answer()
    {
        return $this->answer;
    }

    public function fields(): array
    {
        if (is_null($this->fields)) {
            $this->fields = $this->preparation_data_to_array($this->request->response()); //trait
        }
        return $this->fields;
    }

    public function headers(): array
    {
        if (is_null($this->headers)) {
            $this->headers = $this->request->headers();
        }
        return $this->headers;
    }
}