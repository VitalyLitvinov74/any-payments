<?php


namespace AnyPayments\v3\io;

use AnyPayments\v3\interfaces\IData;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @property IData $fields
 */
class FieldsOf implements IData
{
    private $fields;

    /**
     * @param string|array $fields - может быть строкой, html, строкой json, строкой query(get запрос), массивом
     */
    public function __construct($fields, $output_type)
    {
        $this->fields = $fields;
        switch ($output_type) {
            case "json":
                $fields = new JsonFields($fields);
                break;
            case "url":
                $fields = new UrlFields($fields);
                break;
            case "xml":
                $fields = new XmlFields($fields);
                break;
        }
        $this->fields = $fields;
    }

    private function data_type(): string
    {
        $fields = $this->fields;
        if (is_string($fields)) {
            return 'string';
        } elseif (is_array($fields)) {
            return 'array';
        }
        return 'undefined';
    }

    public function content()
    {
        return $this->fields->content();
    }
}
