<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IStream;
use AnyPayments\v3\meedoo\Medoo;

/**
 * @property Medoo $db
 * @property IStream $stream
 */
class LogStream
{
    private $db;
    private $stream;
    private $psp_name;

    public function __construct(Medoo $db, string $psp_name)
    {
        $this->db = $db;
        $this->psp_name = $psp_name;
    }

    public function write(IStream $stream, bool $input_request): void
    {
        try {
            $fields = $stream->read_body();
            $headers = $stream->read_headers();
            if (is_array($fields)) {
                $fields = json_encode($fields);
            }
            if (preg_match('#<\S+>#', $fields)) { //если строка html то ее логировать не нужно.
                $fields = ['html'];
            }
            $this->db->insert('any_payments_log', [
                'fields' => $fields,
                'headers' => json_encode($headers),
                'psp_class'=> $this->psp_name,
                'input'=>$input_request,
                'output'=>!$input_request
            ]);

        } catch (\Exception $e) {
            $response = $e;
        }
    }
}
