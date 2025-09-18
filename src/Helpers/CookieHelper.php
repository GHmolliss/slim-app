<?php

declare(strict_types=1);

namespace App\Helpers;

final class CookieHelper
{
    public const TOKEN_KEY = 'token';

    public static function findByKey(string $key, mixed $default = null): mixed
    {
        return $_COOKIE[$key] ?? $default;
    }
}
