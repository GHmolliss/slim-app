<?php

declare(strict_types=1);

namespace App\Helpers;

final class StrHelper
{
    public static function trim(string $value): string
    {
        return trim($value);
    }

    public static function lower(string $value): string
    {
        return mb_strtolower($value, 'UTF-8');
    }

    public static function upper(string $value): string
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    public static function prepareEmail(string $value): string
    {
        $value = self::trim($value);
        $value = self::lower($value);

        return $value;
    }

    public static function preparePassword($value): string
    {
        $value = self::trim($value);

        return $value;
    }

    public static function prepareUserName($value): string
    {
        $value = self::trim($value);
        $value = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');

        return $value;
    }

    public static function getPlainTextByHtml(string $html): string
    {
        $plainText = strip_tags($html);
        $plainText = html_entity_decode($plainText);

        $lines = explode(PHP_EOL, $plainText);

        $filteredLines = array_filter($lines, function ($line) {
            return trim($line) !== '';
        });

        return implode(PHP_EOL, array_map('trim', $filteredLines));
    }

    public static function getWordCount(string $text): int
    {
        $words = preg_split('/\P{L}+/u', $text, -1, PREG_SPLIT_NO_EMPTY);

        return count($words);
    }
}
