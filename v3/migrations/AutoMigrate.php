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
     * @param Medoo $db - конфиг базы данных
     */
    public function __construct(string $prefix, Medoo $db) {
        $this->prefix = $prefix;
        $this->db = $db;
    }

    protected function create_table(string $table_name, array $columns){
        $this->db->create($table_name, $columns);
    }

    protected function drop_table(string $table_name){
        $this->db->drop($table_name);
    }

    protected function primary_key(): array{
        return [
            "INT",
            "NOT NULL",
            "AUTO_INCREMENT",
            "PRIMARY KEY"
        ];
    }

    protected function string(int $length = 255): array{
        return [
            "VARCHAR(".$length.")"
        ];
    }

    protected function int(): array{
        return ["INT"];
    }

    protected function tiny_int(): array{
        return ["tinyint(1)"];
    }

    protected function float(): array{
        return ["FLOAT"];
    }
}