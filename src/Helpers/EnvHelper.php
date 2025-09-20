<?php

declare(strict_types=1);

namespace App\Helpers;

use LogicException;

final class EnvHelper
{
    public static function getAppUrlDs(): string
    {
        return self::getByKey('APP_URL');
    }

    public static function isDev(): bool
    {
        $value = self::getByKey('APP_ENV');

        return ($value === 'development') ? true : false;
    }

    public static function isProd(): bool
    {
        $value = self::getByKey('APP_ENV');

        return ($value === 'production') ? true : false;
    }

    public static function getAppSecret(): string
    {
        return self::getByKey('APP_SECRET');
    }

    public static function getJwtSecret(): string
    {
        return self::getByKey('JWT_SECRET');
    }

    private static function getByKey(string $key): string
    {
        $value = $_ENV[$key] ?? null;

        if ($value === null) {
            throw new LogicException("Переменная окружения не найдена env={$key}.");
        }

        return $value;
    }
}
