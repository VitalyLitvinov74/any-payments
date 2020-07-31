<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;
use AnyPayments\v3\io\FieldsOf;
use AnyPayments\v3\io\HeadersOf;
use AnyPayments\v3\meedoo\Medoo;

/**
 * Отправляет/принимает запросы в платежную систему
 * Алгоритм:
 * 1. формируем заголовки для запроса.
 * 2. формирует тело запроса.
 * 3. формируем запись в биллинге.
 * 4. передаем п.1,2 в поток отправки.
 * 4.1. логируем п.1,2
 * 5. принимаем ответ и передаем этот ответ в конкретный обрабочик платежной системы
 * (там он этот ответ будет обрабатывать по своему)
 * 6. логируем ответ.
 *
 * @property IFromCommandOfPayment $psp
 * @property Medoo $db
 * @property array $db_connection
 * @property array $fields
 * @property array $headers
 */
class PaymentOf implements IHandlerOfPayment
{
    private $psp;
    private $db;
    private $db_connection;
    private $headers;
    private $fields;

    public function __construct(IFromCommandOfPayment $psp, array $db_connection)
    {
        $this->psp = $psp;
        $this->db_connection = $db_connection;
        $this->db = new Medoo([
            'database_type' => $db_connection['db_type'],
            'database_name' => $db_connection['db_name'],
            'server' => $db_connection['db_host'],
            'username' => $db_connection['username'],
            'password' => $db_connection['password']
        ]);
    }

    public function pay()
    {

        return false; //или ошибка.
    }

    private function add_to_billing()
    {

    }

    /*private function tables_valid(): bool
    {
        $this->db->has('information_schema.tables', [
            "AND" => [
                'table_schema' => $this->db_connection["db_name"],
                'table_name' => $this->tables_prefix() . "billing"
            ],
        ]);
        if ($this->needle_migration()) {

        } else {
            //выдаем ошибку.
        }
    }

    private function needle_migration(): bool
    {
        if (isset($this->db_connection['needle_auto_migration'])) {
            return $this->db_connection['needle_auto_migration'];
        }
        return false;
    }

    private function tables_prefix(): string
    {
        if (isset($this->db_connection['prefix_any_payments'])) {
            return $this->db_connection['prefix_any_payments'] . '_';
        }
        return "any-payments" . "_";
    }

    private function has_table(string $table_name){

    }*/
}