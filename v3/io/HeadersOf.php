<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
/**
 * @property array $header
 *
*/
class HeadersOf implements IData
{
    private $header;
    /**
     * @param array $header - ["key"=>"value"]
     */
    public function __construct($header)
    {
        $this->header = $header;
    }

    public function array(): array
    {
        $arr = [];
        foreach ($this->header as $header => $value) {
            $arr[] = $header . ': ' . $value;
        }
        return $arr;
    }
}