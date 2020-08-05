<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
use AnyPayments\v3\interfaces\IStream;

/**
 * @property bool $already_send - указывает был ли отправлен запрос.
 * @property string $response - ответ от платежной системы.
 * @property string $url - урл, куда отправлять запрос.
 * @property string $response_headers  - заголовки, которые пришли с ответом.
 */
class OutputStreamTo implements IStream
{
    private $already_send = false;
    private $response;
    private $url;
    private $response_headers;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function send(IData $header, IData $fields): IStream
    {
        if ($this->already_send){
            return $this;
        }

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            $this->options(
                $header->array(),
                $fields->array()
            ));
        $this->response = curl_exec($curl);
        curl_close($curl);
        $this->already_send = true;
        return $this;
    }

    private function options(array $header, array $fields): array
    {
        return [
            CURLOPT_URL => $this->url,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_RETURNTRANSFER => true,
        ];
    }

    /**
     * @return bool|string
     * @throws \Exception
     */
    public function read_body(): string
    {
        if ($this->already_send) {
            return $this->response;
        }
        throw new \Exception('Request was not sent.');
    }

    /**
     * читает заголовки ответа
     * @return string
     * @throws \Exception
     */
    public function read_headers(): string
    {
        if($this->already_send){
            return ;
        }
        throw  new \Exception('Request was not sent.');
    }
}