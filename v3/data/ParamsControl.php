<?php


namespace AnyPayments\v3\data;


use yii\helpers\VarDumper;

class ParamsControl implements DataInterface
{
    private $table;
    private $possible_fields;
    private $real_params;

    public function __construct( array $possible_fields)
    {
        $this->table = New Param(); //����������� ������ �����. ��� new � ������ ������� �� ������ ����� ������.
        $this->possible_fields = $possible_fields;
        $this->check();
    }

    private function check(): void
    {
        foreach ($this->possible_fields as $field => $type) {
            if (!$this->param_existed($field, $type)) {
                $this->create_new_param($field, $type);
            }
        }
    }

    /*
     * ��������� ��� ��� �������� � ����
     * */
    private function param_existed($param_name, $param_type): bool
    {
        if (!$this->real_params) { //����� �� ������ ����� �������� � ����
            $this->real_params = $this->table->find(); //�����
        }
        $real_params = $this->real_params;
        if (count($real_params) === 0
            or !$this->param_existed_in_array($real_params, $param_name, $param_type))
        {
            return false;
        }
        return true;
    }

    private function create_new_param($param, $type): void
    {
        $class = get_class($this->table); //�� ������� new Param(), ����� �� ����������� ����������� �� ������������.
        /**@var Param $table */
        $table = new $class(['param'=>$param, 'type'=>$type]);//�����
//        $table = new Param(['param'=>$param, 'type'=>$type]);//������, ����������� ������ � ������������.
        $table->save();
    }

    /*
     * ��������� ���� �� ������� � ������� (������ ������� �� ���� � ������������ �������).
     * */
    private function param_existed_in_array($real_params, $param_name, $param_type): bool
    {
        $indicator = false;
        foreach ($real_params as $record) {
            if ($record->param == $param_name and $record->type == $param_type) {
                $indicator = true;
            }
        }
        if (!$indicator) {
            return false;
        }
        return true;
    }

    /**
     * Возвращает преобразованный тип данных
     */
    public function content()
    {
        // TODO: Implement content() method.
    }
}