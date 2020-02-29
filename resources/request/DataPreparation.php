<?php


namespace AnyPayments\resources\request;

/*
 * ������ ����� ��������������� ������ � ����������� ���. �������� � ������ � OutputRequest
 * ����� ����������� ������� "�������"
 * */

use AnyPayments\interfaces\DataPreparationInterface;
use AnyPayments\resources\fields\Fields;
use AnyPayments\resources\fields\Headers;

class DataPreparation
{
    private $headers;
    private $fields;

    public function __construct($headers, $fields)
    {
        $this->headers = $headers;
        $this->fields = $fields;
    }

    /*
     * ���������� ��������������� ������ ����������.
     * */
    public function headers(): DataPreparationInterface
    {
        $headers = $this->headers;
        if ($this->not_verification($headers)) {
            $headers = $this->headers_to_type($headers);
        }
        return $headers;
    }

    /*
     * ���������� ��������������� ������ �����
     * */
    public function fields(): DataPreparationInterface
    {
        $fields = $this->fields;
        if ($this->not_verification($fields)) {
            $fields = $this->fields_to_type($fields);
        }
        return $fields;
    }

    /*
     * ��������� �������� �� ���� ��� ��������� ����� DataPreparationInterface
     * */
    private function not_verification($data): bool
    {
        if(!is_object($data) and !is_string($data))
        {
            return true;
        }
        $interfaces = class_implements($data);
        foreach ($interfaces as $interface) {
            if ($interface === 'DataPreparation') {
                return true;
            }
        }
        return false;
    }

    /*
     * ����������� ��������� � ���� DataPreparationInterface
     * */
    private function headers_to_type($headers)
    {
        if (is_array($headers))
        {
            return new Headers($headers);
        }
        return $headers;
    }

    /*
     * ����������� ���� � ���� DataPreparationInterface
     * */
    private function fields_to_type($fields)
    {
        if(is_array($fields))
        {
            return new Fields($fields);
        }
        return $fields;
    }
}