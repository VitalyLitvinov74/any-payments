<?php


namespace AnyPayments\v3\io;

use AnyPayments\v3\interfaces\IData;

/**
 * @property array $fields - EXAMPLE:
 *  [
 *      'root'=>[
 *          @attributes=>[
 *              attr1=>val1
 *          ]
 *      ]
 *  ]
 *  root - корневой элемент.
*/
class XmlFields implements IData
{
    private $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Возвращает преобразованный тип данных
     */
    public function content()
    {
        $first_key = key($this->fields);
        $fields = $this->fields[$first_key];
        $xml = Array2XML::createXML($first_key, $fields);
//        header('Content-type: text/xml');
//        print_r($xml->saveXML($xml->documentElement));die;
        return $xml->saveXML($xml->documentElement);
    }
}
