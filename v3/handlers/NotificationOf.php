<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfNotification;
use AnyPayments\v3\interfaces\IHandlerOfNotification;
use AnyPayments\v3\io\InputStreamBy;
use AnyPayments\v3\meedoo\Medoo;

/**@property  IFromCommandOfNotification $psp
 * @property array $db_connection
 * @property Medoo $db
 * @property InputStreamBy $request
 * @property string $answer
 * @property bool $has_error
 */
class NotificationOf implements IHandlerOfNotification
{
    private $psp;
    private $db;
    private $request;
    private $db_connection;
    private $answer;
    private $has_error;

    public function __construct(IFromCommandOfNotification $psp, array $db_connection)
    {
        $this->db_connection = $db_connection;
        $this->db = new Medoo([
            'database_type' => $db_connection['db_type'],
            'database_name' => $db_connection['db_name'],
            'server' => $db_connection['db_host'],
            'username' => $db_connection['username'],
            'password' => $db_connection['password']
        ]);
        $this->psp = $psp;
        $this->log($this->headers(), $this->fields());
        $this->request = new InputStreamBy();
        if ($psp->transaction_id($this->fields())) {
            $this->enjoy();
        }
        $this->psp = $psp;
    }

    public function psp()
    {
        return $this->psp;
    }

    public function answer(){
        return $this->answer;
    }


    private function enjoy()
    {
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

    private function updated_billing()
    {
        $trans_id = $this->psp->transaction_id($this->fields());
        $record = $this->db->select('payments_billing', 'id',
            ['transaction_id' => $trans_id, 'paid' => 0]);
        if (!empty($record)) { //если запись есть то все ок.
            $this->db->update('any_payments_billing',
                [
                    'paid' => 1,
                    'psp_transaction_id' => $this->psp->transaction_id($this->fields()),
                ],
                [
                    'transaction_id' => $this->psp->transaction_id($this->fields())
                ]);
            return true;
        }
        return false;
    }

    private function log($header, $response)
    {
        $this->db->insert('any_payments_log', [
            'headers' => json_encode($header),
            'fields' => json_encode($response),
        ]);
    }

    private function fields(): array
    {

    }

    private function headers(): array{

    }


}
