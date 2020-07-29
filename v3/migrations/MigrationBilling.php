<?php


namespace AnyPayments\v3\migrations;


class MigrationBilling extends AutoMigrate
{

    /**
     * выполняет миграцию
     */
    public function up(): void
    {
        $this->create_table();
    }

    /**
     * Откатывает миграцию
     */
    public function down(): void
    {

    }
}