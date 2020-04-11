<?php


namespace AnyPayments\resources;


use AnyPayments\connectors\Medoo;
use AnyPayments\interfaces\IPayment;
use AnyPayments\resources\data\Fields;
use AnyPayments\resources\data\Headers;
use AnyPayments\resources\request\ServerToPsp;

/**
 * @property IPayment $psp
*/
class Payment
{
    use PreparationData;

    private $request;
    private $medoo;
    private $psp;

    public function __construct(IPayment $psp)
    {
        $this->request = new ServerToPsp(
            new Headers($psp->headers()),
            new Fields(
                $psp->fields(),
                $psp->output_fields_type()
            ),
            $psp->api_url()
        );
        $this->psp = $psp;
        $this->medoo = new Medoo();
    }

    public function response()
    {
        return $this->request->response();
    }

    private function redirect($response): void
    {
        $this->psp->redirect($response);
    }

    private function save_data($response): void
    {
        $this->log(//лог того что отправляем
            $this->psp->headers(),
            $this->psp->fields()
        );
        $this->add_to_billing($this->psp);
        $this->log(['answer'], $response); //лог того что пришло
        //здесь отправить статус pending
    }

    private function add_to_billing(IPayment $psp): void
    {
        $this->medoo->insert('payments_billing', [
            'transaction_id' => $psp->transaction_id(),
            'paid' => false,
            'psp_transaction_id' => '',
            'user_id' => $psp->card()->user_id(),
            'amount' => $psp->card()->amount(),
            'currency' => $psp->card()->currency()
        ]);
    }

    /**Записывает лог данных
     * @param array $headers
     * @param array|string $fields
     */
    private function log(array $headers, $fields): void
    {
        if (is_array($fields)) {
            $fields = json_encode($fields);
        }
        if (preg_match('#<\S+>#', $fields)) { //если строка html то ее логировать не нужно.
            $fields = ['html'];
        }
        $this->medoo->insert('payments_logger', [
            'fields' => $fields,
            'headers' => json_encode($headers)
        ]);
    }

    public function enjoy(): void
    {
        $response = $this->response();
        $this->save_data($response);
        $this->redirect($response);
    }

    public function psp(): IPayment
    {
        return $this->psp;
    }
}