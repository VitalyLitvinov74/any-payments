<?php


namespace AnyPayments\v3\interfaces;


interface IMigration
{
    /**
     * выполняет миграцию
    */
    public function up(): void;

    /**
     * Откатывает миграцию
    */
    public function down(): void;
}