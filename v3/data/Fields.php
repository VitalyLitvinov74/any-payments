<?php


namespace AnyPayments\v3\data;


use constructor\Constructor;
use yii\helpers\VarDumper;

/**
 * Если будет нужно обратное преобразование типов например из json в array - дописать вторичный конструктор.
 * @property DataInterface $fields
 * @property string $output_type;
*/
class Fields implements DataInterface
{
    private $fields;

    /**
     * @param array $fields
     * @param string $output_type - тип в который нужно преобразовать поля.
     */
    public function __construct(array $fields, string $output_type)
    {
        switch ($output_type){
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

    public function content(){
        return $this->formatted_object()->content();
    }

    private function formatted_object(): DataInterface
    {
        return $this->fields;
    }
}