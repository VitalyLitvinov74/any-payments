<?php


namespace AnyPayments\v3\interfaces;

/**
 * Этот интерфейс должен реализовать класс, который занимается исключительно обработкой и валидацией формы.
 * в данном случае это CardForm
 */
interface ICardForm
{
    /** сумма которую нужно передать в psp в удобном для вас формате. */
    public function amount();

    /** номер карты */
    public function number();

    /** Защитный код карты*/
    public function cvv();

    /** срок действия карты*/
    public function date();

    /** Проводит валидацию формы */
    public function validated(): bool;

    /** возвращает фамилию держателя карты*/
    public function lastName(): string;

    /** Возвращает имя держателя карты*/
    public function firstName(): string;

    /** Телефон держателя карты*/
    public function phone(): string;

    /** e-mail держателя карты*/
    public function email(): string;

    /** Валюта в которой производится операция*/
    public function currency();

    /** Город проживания пользователя*/
    public function city(): string;

    /** страна проживания пользователя*/
    public function country(): string;

    /** код города*/
    public function zip_code(): int;

    /** адресс проживания пользователя*/
    public function address(): string;

    /** штат или обл. проживания пользователя.*/
    public function state(): string;

    /**Возвращает id пользователя, который проводит оплату*/
    public function user_id(): int;

    /** возвращает имя текущей платежной системы*/
    public function scenario(): string;
}