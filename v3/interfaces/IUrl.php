<?php


namespace AnyPayments\v3\interfaces;


interface IUrl
{

    /**
     * @param array $get_params
     * @return string - страница с сообщением о неудачной транзакции
     */
    public function fail_url(array $get_params = []): string;

    /**
     *
     * @param array $get_params
     * @return string - страница куда будут приходить уведомления от платежной системы
     */
    public function callback_url(array $get_params = []): string;

    /**
     * @param array $get_params
     * @return string - возвращаетстраницу в зависимости от какиех - либо условий,
     * например условий в бд. или еще каких то.
     */
    public function after_payment_url(array $get_params = []): string;

    /**
     * @param array $get_params
     * @return string - url страницы с сообщением об удачной оплате
     */
    public function success_url(array $get_params = []): string;

    /**
     * Страница ожидания платежа (если есть)
     * @param array $get_params
     * @return string
     */
    public function pending_url(array $get_params = []): string;
}
