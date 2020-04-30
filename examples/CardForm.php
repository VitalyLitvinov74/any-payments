<?php


namespace AnyPayments\examples\models;


use AnyPayments\v3\interfaces\ICardForm;
/**
 * this model not validated post fields
 * she can used as target only for example
 *
 * @property $post;
 */
class CardForm implements ICardForm
{
    private $post;

    public function __construct(array $post) {
        $this->post = $post;
    }

    /** сумма которую нужно передать в psp в удобном для вас формате. */
    public function amount()
    {
        return $this->post['amount'];
    }

    /** номер карты */
    public function number()
    {
        return '4111 1111 1111 1111';
    }

    /** Защитный код карты*/
    public function cvv()
    {
        return '111';
    }

    /** срок действия карты
     * expire date
     */
    public function date()
    {
        return '30/01';
    }

    /** возвращает фамилию держателя карты*/
    public function lastName(): string
    {
        return 'Ivanov';
    }

    /** Возвращает имя держателя карты*/
    public function firstName(): string
    {
        return 'Ivan';
    }

    /** Телефон держателя карты*/
    public function phone(): string
    {
        return '+00000000000000';
    }

    /** e-mail держателя карты*/
    public function email(): string
    {
        return 'email@email.ru';
    }

    /** Валюта в которой производится операция*/
    public function currency()
    {
        return $this->post['currency'];
    }

    /** Город проживания пользователя*/
    public function city(): string
    {
        return 'Moscow';
    }

    /** страна проживания пользователя*/
    public function country(): string
    {
        return 'Russia';
    }

    /** код города*/
    public function zip_code(): int
    {
        return '123456';
    }

    /** адресс проживания пользователя*/
    public function address(): string
    {
        return '';
    }

    /** штат или обл. проживания пользователя.*/
    public function state(): string
    {
        return '';
    }

    public function user_id(): int
    {
        return $this->post['user_id'];
    }

    public function scenario(): string
    {
        return $this->post['scenario'];
    }
}