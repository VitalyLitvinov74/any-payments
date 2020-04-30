<?php


namespace AnyPayments\v3\data;



class Headers implements DataInterface
{
    private $headers;

    public function __construct(array $headers, bool $needed_auth = false)
    {
        $this->headers = $headers;
    }

    public function content(): array
    {
        $arr = [];
        foreach ($this->headers as $header => $value) {
            $arr[] = $header . ': ' . $value;
        }
        return $arr;
    }
}