<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;
use AnyPayments\v3\io\FieldsOf;
use AnyPayments\v3\io\HeadersOf;
use AnyPayments\v3\io\LogStream;
use AnyPayments\v3\io\OutputStreamTo;
use AnyPayments\v3\meedoo\Medoo;

/**
 * Отправляет/принимает запросы в платежную систему
 * Алгоритм:
 * 1. формируем заголовки для запроса.
 * 2. формирует тело запроса.
 * 3. формируем запись в биллинге.
 * 4. передаем п.1,2 в поток отправки.
 * 4.1. логируем п.1,2
 * 5. принимаем ответ и передаем этот ответ в конкретный обрабочик платежной системы
 * (там он этот ответ будет обрабатывать по своему)
 * 6. логируем ответ.
 *
 * @property IFromCommandOfPayment $psp
 * @property Medoo $db
 * @property array $db_connection
 * @property FieldsOf $fields
 * @property HeadersOf $headers
 * @property OutputStreamTo $stream;
 * @property  LogStream $log
 */
class PaymentOf implements IHandlerOfPayment
{
    private $psp;
    private $db;
    private $db_connection;
    private $headers;
    private $fields;
    private $stream;
    private $log;

    public function __construct(IFromCommandOfPayment $psp, array $db_connection)
    {
        $this->psp = $psp;
        $this->db_connection = $db_connection;
        $this->db = new Medoo([
            'database_type' => $db_connection['db_type'],
            'database_name' => $db_connection['db_name'],
            'server' => $db_connection['db_host'],
            'username' => $db_connection['username'],
            'password' => $db_connection['password']
        ]);
        $this->stream = new OutputStreamTo($psp->api_url());
        $this->log = new LogStream($this->stream);
        $this->fields = new FieldsOf($psp->fields());
        $this->headers = new HeadersOf($psp->headers());
    }

    public function pay()
    {
        try {
            $resp = $this->stream->send(
                $this->headers,
                $this->fields
            )->read();
            $this->add_to_billing();
        } catch (\Exception $e) {

        }
    }

    private function add_to_billing()
    {
        $psp = $this->psp;
        //отловить ошибку тут.
        $this->db->insert('payments_billing', [
            'transaction_id' => $psp->transaction_id(),
            'paid' => false,
            'psp_transaction_id' => '',
            'user_id' => $psp->card()->user_id(),
            'amount' => $psp->card()->amount(),
            'currency' => $psp->card()->currency()
        ]);
    }
}