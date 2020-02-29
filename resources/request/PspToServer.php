<?php


namespace paymentsmulti\library\resources\request;


use yii\helpers\VarDumper;

class PspToServer
{
    private $jsonBody;
    private $headers;

    function __construct()
    {
        $this->jsonBody = file_get_contents('php://input');
    }

    public function response(): string
    {
        return $this->jsonBody;
    }

    public function headers(): array
    {
        if(!$this->headers or is_string($this->headers)){
            return $this->get_all_headers();
        }
        return $this->headers;
    }

    private function get_all_headers() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}