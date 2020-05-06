<?php


namespace AnyPayments\v3;

/**
 * @property array $config
 */
class Config
{

    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function secret(): array
    {
        if (isset($this->config['secret'])) {
            return $this->config['secret'];
        }
        return [];
    }

    public function db(): array
    {
        if (isset($this->config['db'])) {
            return $this->config['db'];
        }
        if ($this->db_from_constant()) {
            return $this->db_from_constant();
        }
        return [];
    }

    public function config(): array
    {
        return $this->config;
    }

    public static function from_json_file(string $file_path)
    {

    }

    private function db_from_constant()
    {
        if (defined("ANY_PAYMENT_DB")) {
            return ANY_PAYMENT_DB;
        }
        return [];
    }

}