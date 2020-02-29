<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 17.10.2019
 * Time: 16:43
 */

namespace payment_library\interfaces;

/**
 * Этот интерфейс должен реализовать класс, который занимается исключительно обработкой и валидацией формы.
 * в данном случае это CardForm
*/
interface CardInterface
{
    /** сумма которую нужно передать в psp в удобном для вас формате. */
    public function amount();

    /** номер карты */
    public function number();

    /** Защитный код карты*/
    public function cvv();

    /** срок действия карты*/
    public function date();

    /** */
    public function validate();

    /** */
    public function method();

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

    public function user_id(): int;

    public function scenario(): string;
}