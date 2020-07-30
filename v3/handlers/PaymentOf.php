<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfPayment;
use AnyPayments\v3\interfaces\IHandlerOfPayment;
use AnyPayments\v3\meedoo\Medoo;

/**
 * @property IFromCommandOfPayment $psp
 * @property Medoo $db
 * @property array $db_connection
 */
class PaymentOf implements IHandlerOfPayment
{
    private $psp;
    private $db;
    private $db_connection;

    public function __construct(IFromCommandOfPayment $psp, array $db_connection)
    {
        $this->psp = $psp;
        $this->db = new Medoo([
            'database_type' => $db_connection['db_type'],
            'database_name' => $db_connection['db_name'],
            'server' => $db_connection['db_host'],
            'username' => $db_connection['username'],
            'password' => $db_connection['password']
        ]);
        $this->db_connection = $db_connection;
    }

    /*public function pay()
    {
        if ($this->tables_valid()){

        }
        return false; //или ошибка.
    }

    private function add_to_billing()
    {

    }

    private function tables_valid(): bool
    {
        if ($this->needle_migration()){

        }
    }*/

    private function needle_migration(): bool
    {
        if (isset($this->db_connection['needle_auto_migration'])) {
            return $this->db_connection['needle_auto_migration'];
        }
        return false;
    }

    private function tables_prefix(): bool{
        if (isset($this->db_connection['prefix_any_payments'])) {
           return $this->db_connection['prefix_any_payments'];
        }
        return false;
    }
}