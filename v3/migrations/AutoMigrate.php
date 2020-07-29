<?php


namespace AnyPayments\v3\migrations;

use AnyPayments\v3\interfaces\IMigration;
use AnyPayments\v3\meedoo\Medoo;

/**
 * @property string $prefix
 * @property Medoo $db
*/
abstract class AutoMigrate implements IMigration
{

    private $prefix;
    protected $db;

    /**
     * проверяет существование необходимы таблиц.
     * @param string $prefix
     * @param array $db - конфиг базы данных
     */
    public function __construct(string $prefix, array $db) {
        $this->prefix = $prefix;
        $this->db = new Medoo([
                'database_type' => $db['db_type'],
                'database_name' => $db['db_name'],
                'server' => $db['db_host'],
                'username' => $db['username'],
                'password' => $db['password']
            ]);
    }

    protected function create_table(string $db_name, string $table_name, array $tables){

    }

    protected function drop_table(){

    }

    protected function primary_key(){

    }

    protected function string(){

    }

    protected function int(){

    }
}