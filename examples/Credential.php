<?php


namespace AnyPayments\examples;


use AnyPayments\v3\interfaces\ICredential;

/**
 * @property array $secrets - ваши секретные ключи.
*/
class Credential implements ICredential
{

    private $secrets = [
        'auth_key'=>'',
        'public_key'=>'',
    ];

    public function __construct(array $array) {

    }

    public function valueOf(string $name_secret): string
    {
        foreach ($this->secrets as $key=>$val){
            if ($key == $name_secret){
                return $val;
            }
        }
        return 'Not set credentials.';
    }

    public function values(): array
    {
        return $this->secrets;
    }
}