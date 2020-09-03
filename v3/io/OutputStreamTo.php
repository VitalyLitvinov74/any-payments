<?php


namespace AnyPayments\v3\io;


use AnyPayments\v3\interfaces\IData;
use AnyPayments\v3\interfaces\IStream;
use Symfony\Component\VarDumper\VarDumper;

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
        if($this->url){
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                $this->options(
                    $header->content(),
                    $fields->content()
                ));
            $this->response = curl_exec($curl);
//            curl_close($curl);
        }else{
            $this->response = '';
        }
        $this->already_send = true;
        return $this;
    }

    /**
     * @param array $headers - массив заголовков в формате
     * [
     *   'Content-type: application/xml',
     *   'Authorization: gfhjui'
     * ]
     * @param string $fields - сконвертированные поля json|xml|url
     * @return array
     */
    private function options(array $header, string $fields): array
    {
        return [
            CURLOPT_URL => $this->url,
            CURLOPT_HEADER => false,
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
        return 'Request was not sent.';
    }

    /**
     * читает заголовки ответа
     * @return string
     * @throws \Exception
     */
    public function read_headers(): array
    {
        if($this->already_send){
            return [];//переписать.
        }
        return ["Request was not sent."];
    }
}
