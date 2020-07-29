<?php


namespace AnyPayemtns\v3\psp\royalpay;


use AnyPayemtns\v3\psp\AbstractCommandOfPayment;
use AnyPayments\examples\Urls;
use AnyPayments\v3\interfaces\ICardForm;
use AnyPayments\v3\interfaces\IConfig;
use AnyPayments\v3\interfaces\ICredential;
use AnyPayments\v3\interfaces\IUrl;

/**
 * @property IUrl $urls
 * @property ICredential $secret_keys
*/
class RoyalPayPayment extends AbstractCommandOfPayment
{
    private $urls;
    private $secret_keys;

    /**
     * @param ICardForm $card_form - форма которую отправляет пользователь
     * @param ICredential $credential - данные авторизации для данной платежной системы.
     * @param IUrl $urls - содержит информацию о перенаправлении пользователя после транзакции
     */
    public function __construct(ICardForm $card_form, ICredential $credential, IUrl $urls) {
        parent::__construct($card_form);
        $this->secret_keys = $credential;
        $this->urls = $urls;
    }

    /**
     * тип данных в котором будут передаваться поля.
     * @return string = json|url|xml
     */
    public function output_fields_type(): string
    {
        return 'json';
    }

    /**
     * Заголовки которые будут отправлены при создании транзакции.
     */
    public function headers(): array
    {
        return [
            'HOST' => 'royalpay.eu',
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Auth' => $this->auth_key(),
            'Sign' => $this->signature(),
        ];
    }

    /**
     * Поля которые будут отправлены при создании транзакции
     */
    public function fields(): array
    {
        return [
            'transaction_id' => $this->transaction_id(),
            'amount' => $this->card->amount(),
            'currency' => $this->card->currency(),
            'payment_system' => "CardGate",
            'url' => [
                'callback_url' => $this->urls->callback_url(),
                'fail_url' => $this->urls->after_payment_url(),
                'pending_url' => $this->urls->after_payment_url(),
                'success_url' => $this->urls->success_url(),
            ]
        ];
    }

    /**
     * Урл на который будут отправляться запросы.
     */
    public function api_url(): string
    {
        return 'https://royalpay.eu/api/deposit/create';
    }

    /**
     * перенаправляет пользователя после получения ответа от psp
     * @param $response - поля которые пришли от psp
     */
    public function redirect($response): void
    {
        $response = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE and $response['redirect']) {
            $url = $response['redirect']['url'] . '?data=' . $response['redirect']['params']['data'];
        } else {
            $url = $this->urls->fail_url();
        }
        header('Location: ' . $url, true, 302);
        die();
    }

    private function signature()
    {
        if (!$this->sign) {
            $this->sign = md5(json_encode($this->fields()) . $this->secret_key());
        }
        return $this->sign;
    }

    private function auth_key()
    {
        return $this->secret_keys->values()['auth_key'];
    }

    private function secret_key()
    {
        return $this->secret_keys->values()['secret_key'];
    }
}