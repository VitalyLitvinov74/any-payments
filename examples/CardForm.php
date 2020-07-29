<?php


namespace AnyPayments\examples;


use AnyPayments\v3\interfaces\ICardForm;
/**
 * @property array $post - not validated fields;
*/
class CardForm implements ICardForm
{
    private $post;

    public function __construct(array $_post) {
        $this->post = $_post;
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
        return '000';
    }

    /** срок действия карты*/
    public function date()
    {
        return '21/2030';
    }

    /** Проводит валидацию формы */
    public function validated(): bool
    {
        return true;
    }

    /** возвращает фамилию держателя карты*/
    public function lastName(): string
    {
        return 'Holder';
    }

    /** Возвращает имя держателя карты*/
    public function firstName(): string
    {
        return 'Card';
    }

    /** Телефон держателя карты*/
    public function phone(): string
    {
        return '+000000000000000';
    }

    /** e-mail держателя карты*/
    public function email(): string
    {
        return 'example@mai.ru';
    }

    /** Валюта в которой производится операция*/
    public function currency()
    {
        return 'RUB';
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
        return 456550;
    }

    /** адресс проживания пользователя*/
    public function address(): string
    {
        return '';
    }

    /** штат или обл. проживания пользователя.*/
    public function state(): string
    {
        return 'Moscovskaya oblast\'';
    }

    /**Возвращает id пользователя, который проводит оплату*/
    public function user_id(): int
    {
        return $this->post['user_id'];
    }

    /** возвращает имя текущей платежной системы*/
    public function scenario(): string
    {
        return 'royalpay';
    }
}