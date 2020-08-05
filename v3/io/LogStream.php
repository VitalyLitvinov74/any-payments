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

    public function __construct(Medoo $db, IStream $stream)
    {
        $this->db = $db;
        $this->stream = $stream;
    }

    public static function Output(Medoo $db, IData $fields, IData $headers): self
    {
        return new self(
            $db,
            new StreamOfDataFrom(
                $fields,
                $headers
            )
        );
    }

    public static function Input(Medoo $db, IStream $stream): self
    {
        return new self(
            $db,
            $stream
        );
    }

    public function write(): void
    {
        try {
            $response = $this->stream->read_body();
        } catch (\Exception $e) {
            $response = $e;
        }
//        $this->db->insert('');
    }
}