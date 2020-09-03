<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;
use AnyPayments\v3\interfaces\IStream;
use AnyPayments\v3\io\BillingOf;
use AnyPayments\v3\io\FieldsOf;
use AnyPayments\v3\io\HeadersOf;
use AnyPayments\v3\io\LogStream;
use AnyPayments\v3\io\OutputStreamTo;
use AnyPayments\v3\io\StreamOfDataFrom;
use AnyPayments\v3\meedoo\Medoo;
use Symfony\Component\VarDumper\VarDumper;

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
 * @property IFromCommandOfPayment $psp
 * @property Medoo $db
 * @property array $db_connection
 * @property FieldsOf $fields
 * @property HeadersOf $headers
 * @property OutputStreamTo $stream;
 * @property  LogStream $log
 * @property IStream $stream_of_data
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
    private $stream_of_data;

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
        $this->stream = new OutputStreamTo($psp->api_url()); //поток входных данных.
        $this->fields = new FieldsOf($psp->fields(), $psp->output_fields_type());
        $this->headers = new HeadersOf($psp->headers());
        $this->log = new LogStream($this->db, $this->psp->card()->scenario());
        $this->stream_of_data = new StreamOfDataFrom($this->fields, $this->headers);
        BillingOf::New($this->db, $psp);
    }

    public function pay()
    {
        try {
            $this->log->write($this->stream_of_data, false); //логируем отправляемое
            $this->log->write($this->stream, true); //логируем ответ
            if ($this->stream()->read_body() == 'Request was not sent.'){
                $this->send_pre_request();
            }
            $this->psp->redirect($this->stream->read_body());
        } catch (\Exception $e) {

        }
    }

    public function send_pre_request(): void{
        $this->stream->send( //отправляем запрос
            $this->headers,
            $this->fields
        );
    }

    public function psp(): IFromCommandOfPayment{
        return $this->psp;
    }

    public function stream(): OutputStreamTo{
        return $this->stream;
    }

}
