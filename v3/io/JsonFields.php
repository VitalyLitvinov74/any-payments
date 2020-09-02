<?php


namespace AnyPayments\v3\io;



use AnyPayments\v3\interfaces\IData;

/**
 * @property array $fields - поля которые нужно преобразовать.
*/
class JsonFields implements IData
{
    private $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function content()
    {
        return json_encode($this->fields);
    }

   /* public function conversation_type(): array
    {
        $fields = $this->fields;
        if (filter_var($fields, FILTER_VALIDATE_URL)) {
            parse_str($fields, $result);
            return $result;
        }else if(is_array($fields)){
            return $fields;
        }
    }*/
}
