<?php


namespace AnyPayemtns\v3\psp;


use AnyPayments\v3\interfaces\ICardForm;
use AnyPayments\v3\interfaces\IFromCommandOfPayment;

/**
 * @property ICardForm $card
*/
abstract class AbstractCommandOfPayment implements IFromCommandOfPayment
{
    private $card;

    /**
     * Принимает на вход форму карты.
     * преобразует эти данные и передает в psp через библеотеку payments.
     *
     * @param ICardForm $card
     */
    public function __construct(ICardForm $card) {
        $this->card = $card;
    }

    /**
     * @return string - уникальный id транзакции
    */
    public function transaction_id(): string
    {
        return md5($this->card()->user_id() . time() . rand(0, 999));
    }

    /**
     * @return ICardForm - модель которая принимает на вход карту.
    */
    public function card(): ICardForm
    {
        return $this->card;
    }

    /**
     * @param string $data - произвольная строка.
     * @return array - возвращает массив, получившийся из строки.
     */
    private function array_from_string(string $data): array
    {
        $result = json_decode($data, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }
        parse_str($data, $result);
        return $result;
    }

    /**
     * для транслитерации русских символов в английские.
    */
    private function translit(string $s = 'строка'): string
    {
        $s = (string)$s;
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ь' => '', 'ъ' => ''));
        return $s;
    }

}