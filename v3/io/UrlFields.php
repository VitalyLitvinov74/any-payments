<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;

/**
 * @property array $fields - поля которые нужно преобразовать
*/
class UrlFields implements IData
{

    private $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function content()
    {
        return http_build_query($this->fields);
    }

}
