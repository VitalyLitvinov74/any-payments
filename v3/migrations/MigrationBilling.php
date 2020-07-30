<?php


namespace AnyPayments\v3\migrations;


class MigrationBilling extends AutoMigrate
{

    /**
     * выполняет миграцию
     */
    public function up(): void
    {
        $this->create_table('any_payments_billing', [
            'id'=>$this->primary_key(),
            'transaction_id'=>$this->string(),
            'paid'=>$this->tiny_int(),
            'user_id'=>$this->int(),
            'psp_transaction_id' => $this->string(),
            'amount'=>$this->float(),
            'currency'=>$this->string()
        ]);
    }

    /**
     * Откатывает миграцию
     */
    public function down(): void
    {
        $this->drop_table('any_payments_billing');
    }
}