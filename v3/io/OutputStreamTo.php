<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;

/**
 * @property bool $already_send - указывает был ли отправлен запрос.
 * @property string $response - ответ от платежной системы.
 * @property string $url - урл, куда отправлять запрос.
 * @property string $response_headers  - заголовки, которые пришли с ответом.
 */
class OutputStreamTo
{
    private $already_send = false;
    private $response;
    private $url;
    private $response_headers;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function send(IData $header, IData $fields): void
    {
        if ($this->already_send){
            return;
        }

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            $this->options(
                $header->array(),
                $fields->array()
            ));
        $this->response = curl_exec($curl);
        $this->already_send = true;
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
    public function response(): string
    {
        if ($this->already_send) {
            return $this->response;
        }
        throw new \Exception('Request was not sent.');
    }
}