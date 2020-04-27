<?php


namespace paymentsmulti\library\resources\data;


/**
 * @property array $fields - поля которые нужно преобразовать
*/
class UrlFields implements DataInterface
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