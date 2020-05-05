<?php


namespace AnyPayments\v3\data;

/**
 * @property array|string $fields
 */
class Fields
{
    private $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    private function data_type(): string
    {
        $fields = $this->fields;
        if (is_string($fields)){

        }
        return 'json';
    }

    private function is_json(string $string):bool{

    }

    private function is_url(string $string): bool{

    }
}