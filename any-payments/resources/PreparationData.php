<?php


namespace AnyPayments\resources;


trait PreparationData
{
    private function preparation_data_to_array($data): array
    {
        if (is_string($data)) {
            return $this->convert_from_string($data);
        } else if (is_array($data)) {
            return $data;
        }
        return []; //если обьъект или число.
    }

    private function convert_from_string(string $data): array
    {
        $result = json_decode($data, true); //json
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }
        //xml
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($data);
        if ($xml){
            $json = json_encode($xml);
            $array = json_decode($json,true);
            if (json_last_error() === JSON_ERROR_NONE){
                return $array;
            }
        }
        parse_str($data, $result); // url
        return $result;
    }
}