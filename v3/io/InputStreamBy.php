<?php


namespace AnyPayments\v3\io;

use AnyPayments\v3\interfaces\IData;
use AnyPayments\v3\interfaces\IStream;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @property string $body;
*/
class InputStreamBy implements IStream
{
    private $body;
    private $headers;

    function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->body = $_SERVER['QUERY_STRING'];
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->body = file_get_contents('php://input'); //urlencoded
            if($this->body == ""){ //form-data
                $this->body = json_encode($_POST);
            }
        }

    }

    private function get_all_headers()
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    /**
     * отправляет содержимое на сервер платежной системы
     * @param IData $header - заголовки
     * @param IData $fields - поля
     * @return IStream
     */
    public function send(IData $header, IData $fields): IStream
    {
        echo $fields->content();
        return $this;
    }

    /**
     * читает ответ от платежной системы.
     * @return string
     * @throws \Exception
     */
    public function read_body(): string
    {
        return $this->body;
    }

    /**
     * читает заголовки ответа
     * @return string
     */
    public function read_headers(): array
    {
        if (!$this->headers or is_string($this->headers)) {
            return $this->get_all_headers();
        }
        return $this->headers;
    }
}
