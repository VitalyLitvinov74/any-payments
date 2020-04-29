<?php


namespace paymentsmulti\library\resources\request;

use paymentsmulti\library\resources\data\DataInterface;
use yii\helpers\VarDumper;

/**
 * Класс который отправляет запросы на сервер платежной системы.
 * @property array  $params_curl
 * @property array  $headers
 * @property array  $fields;
 * @property string $url;
 * */
class ServerToPsp
{

    private $fields;
    private $headers;
    private $url;

    private $answer_headers;
    private $exec;
    private $stringAuth;

    private $params_curl = [];

    /**
     * @param DataInterface $headers
     * @param DataInterface $fields
     * @param string        $url - если равен пустой строке значит запрос делать не нужно, скорее всего это get запрос.
     */
    public function __construct(DataInterface $headers, DataInterface $fields, string $url)
    {
        $this->headers = $headers->content();
        $this->fields = $fields->content();
        $this->url = $url;
        $this->send();
    }

    private function send(): void
    {
        if (!$this->exec and $this->url) {
            $curl = curl_init();
            curl_setopt_array($curl, $this->params());
            $this->exec = curl_exec($curl);
            if ($this->exec === false) {
                $this->exec = '';
            }
            $this->answer_headers = curl_getinfo($curl, CURLINFO_HEADER_OUT);
//            curl_close($curl);
        }
        if (!$this->url) {
            $this->exec = '';
        }
    }

    private function params(): array
    {
        if (!$this->params_curl) {
            return [
                CURLOPT_URL => $this->url,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLINFO_HEADER_OUT => true,
                CURLOPT_HTTPHEADER => $this->headers, //array
                CURLOPT_POSTFIELDS => $this->fields, //mixed
                CURLOPT_RETURNTRANSFER => true,
            ];
        }
        return $this->params_curl;
    }

    /**
     * @return string - result curl request - answer request (json)
     * */
    public function response(): string
    {
        if (!$this->exec) {
            $this->send();
        }
        return $this->exec;
    }

    /**
     * @return string - result headers of curl request - answer headers
     */
    public function response_headers(): string
    {
        if (!$this->answer_headers) {
            $this->send();
        }
        return $this->answer_headers;
    }

}