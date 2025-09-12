<?php

declare(strict_types=1);

namespace App\Helpers;

final class TranslateHelper
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public static function create(string $text): string
    {
        $translate = new self($text);

        return $translate->get();
    }

    public function get(): string
    {
        $text = trim($this->text);
        $text = mb_convert_case($text, MB_CASE_LOWER);
        $text = preg_replace("/&[a-z]+;/iu", '-', $text);
        $text = preg_replace("/\s{2,}/iu", ' ', $text);

        $symbols = preg_split('//iu', $text, -1, PREG_SPLIT_NO_EMPTY);

        $replaces = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e',
            'f' => 'f',
            'g' => 'g',
            'h' => 'h',
            'i' => 'i',
            'j' => 'j',
            'k' => 'k',
            'l' => 'l',
            'm' => 'm',
            'n' => 'n',
            'o' => 'o',
            'p' => 'p',
            'q' => 'q',
            'r' => 'r',
            's' => 's',
            't' => 't',
            'u' => 'u',
            'v' => 'v',
            'w' => 'w',
            'x' => 'x',
            'y' => 'y',
            'z' => 'z',

            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',

            '*' => 'x',
            '+' => '-plus-'
        ];


        foreach ($symbols as $index => $symbol) {
            $symbols[$index] = (array_key_exists($symbol, $replaces))
                ? $replaces[$symbol]
                : '-';
        }

        $result = implode('', $symbols);
        $result = trim($result, '-');
        $result = preg_replace("/-{2,}/iu", '-', $result);

        return $result;
    }
}
