<?php


namespace AnyPayments\v3\io;

use AnyPayments\v3\interfaces\IData;

/**
 * @property array|string $fields
 */
class FieldsOf implements IData
{
    private $fields;

    /**
     * @param string|array $fields - может быть строкой, html, строкой json, строкой query(get запрос), массивом
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    private function data_type(): string
    {
        $fields = $this->fields;
        if (is_string($fields)){
            return 'string';
        }elseif (is_array($fields)){
            return 'array';
        }
        return 'undefined';
    }

    private function is_json(string $string):bool{

    }

    private function is_url(string $string): bool{

    }

    private function is_html(string $string): bool{

    }

    public function array(): array
    {
        $fields = $this->fields;
        if($this->data_type() == "string"){
            if($this->is_json($fields)){
                return json_decode($this->fields);
            }
            if($this->is_url($fields)){

            }
        }elseif ($this->data_type() == "array"){
            return $fields;
        }
        return [];
    }
}