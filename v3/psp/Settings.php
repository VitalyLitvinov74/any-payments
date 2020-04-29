<?php


namespace AnyPayments\v2\psp;

use AnyPayments\v2\examples\CardForm;
use AnyPayments\v2\interfaces\ISettings;
use AnyPayments\v2\psp\royalpay\RoyalPayPayment;

/**
 * This is strategy pattern
 * @property string $psp_name
 * @property array $config
 * @property CardForm $card_form
 */
class Settings implements ISettings
{
    private $psp_name;
    private $config;
    private $card_form;

    public function __construct($psp_name = 'RoYaLPay', $config = []) {
        $this->psp_name = strtolower($psp_name);
        $this->config = $config;
        $this->card_form = new CardForm();
    }

    public function psp(){
        switch ($this->psp()){
            default:
                $psp = new RoyalPayPayment($this->card_form);
        }
    }

    /**
     * тип данных в котором будут передаваться поля.
     * @return string = json|url|xml
     */
    public function output_fields_type(): string
    {

    }

    /**
     * Заголовки которые будут отправлены при создании транзакции.
     */
    public function headers(): array
    {
        // TODO: Implement headers() method.
    }

    /**
     * Поля которые будут отправлены при создании транзакции
     */
    public function fields(): array
    {
        // TODO: Implement fields() method.
    }

    /**
     * Урл на который будут отправляться запросы.
     */
    public function api_url(): string
    {
        // TODO: Implement api_url() method.
    }

    /**
     * перенаправляет пользователя после получения ответа от psp
     * @param $response - поля которые пришли от psp
     */
    public function redirect($response): void
    {
        // TODO: Implement redirect() method.
    }

    /**
     * Возвращает id транзакции на нашей стороне.
     */
    public function transaction_id(): string
    {
        // TODO: Implement transaction_id() method.
    }

    /**
     * Возвращает данные формы для записи в бд.
     */
    public function card(): CardInterface
    {
        // TODO: Implement card() method.
    }
}