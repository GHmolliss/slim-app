<?php

declare(strict_types=1);

namespace App\Helpers;

use RuntimeException;

final class CookieHelper
{
    public const TOKEN_KEY = 'token';

    public static function findByKey(string $key, mixed $default = null): mixed
    {
        return $_COOKIE[$key] ?? $default;
    }

    public static function set(string $name, string $value, int $expiration, array $options = []): void
    {
        $result = setcookie($name, $value, [
            'expires' => $expiration,
            'path' => '/',
            'domain' => '', // Или 'localhost', или пустое значение
            'secure' => EnvHelper::getAppHttps(), // Отключить на http
            'httponly' => true,  // Cookies недоступны через JavaScript
            // 'samesite' => 'Lax'  // Разрешает передачу cookies в большинстве случаев
        ]);

        if (!$result) {
            throw new RuntimeException("Cookie не удалось установить name={$name}");
        }
    }
}
