<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
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

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    public function write(IStream $stream): void
    {
        try {
            $response = $stream->read_body();
        } catch (\Exception $e) {
            $response = $e;
        }
//        $this->db->insert('');
    }
}