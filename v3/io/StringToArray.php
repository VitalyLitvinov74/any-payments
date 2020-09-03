<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Обрабатывает только xml|url|json
 * Возвращает массив полученные из входной строки
 * @property string string
*/
class StringToArray implements IData
{
    private $string;

    public function __construct(string $data) {
        $this->string = $data;
    }

    public function content()
    {
        $result = json_decode($this->string, true); //json
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }
        //xml
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->string);
        if ($xml){
            $json = json_encode($xml);
            $array = json_decode($json,true);
            if (json_last_error() === JSON_ERROR_NONE){
                return $array;
            }
        }
        parse_str($this->string, $result); // url
        return $result;
    }
}
