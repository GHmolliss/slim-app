<?php

declare(strict_types=1);

namespace App\Helpers;

use LogicException;

final class EnvHelper
{
    public static function getAppHttps(): bool
    {
        $value = self::getByKey('APP_HTTPS');

        return ($value === 'true') ? true : false;
    }

    public static function isDev(): bool
    {
        $value = self::getByKey('APP_ENV');

        return ($value === 'dev') ? true : false;
    }

    public static function isProd(): bool
    {
        $value = self::getByKey('APP_ENV');

        return ($value === 'prod') ? true : false;
    }

    public static function getAppDebug(): bool
    {
        $value = self::getByKey('APP_DEBUG');

        return ($value === 'true') ? true : false;
    }

    public static function getAppUrl(): string
    {
        return self::getByKey('APP_URL');
    }

    public static function getAppUrlDs(): string
    {
        return self::getAppUrl() . DIRECTORY_SEPARATOR;
    }

    public static function getAppName(): string
    {
        return self::getByKey('APP_NAME');
    }

    public static function getTelegramChannelId(): string
    {
        return $_ENV['TELEGRAM_CHANNEL_ID'];
    }

    public static function getTelegramChannelLinkApp(): string
    {
        return $_ENV['TELEGRAM_CHANNEL_LINK_APP'];
    }

    public static function getTelegramChannelLink(): string
    {
        return $_ENV['TELEGRAM_CHANNEL_LINK'];
    }

    public static function getTelegramTeacherBotToken(): string
    {
        return $_ENV['TELEGRAM_TEACHER_BOT_TOKEN'];
    }

    public static function getTelegramDebugBotToken(): string
    {
        return $_ENV['TELEGRAM_DEBUG_BOT_TOKEN'];
    }

    public static function getTelegramAdminBotToken(): string
    {
        return $_ENV['TELEGRAM_ADMIN_BOT_TOKEN'];
    }

    public static function getTelegramUserAdminId(): string
    {
        return $_ENV['TELEGRAM_USER_ADMIN_ID'];
    }

    public static function getCompanyName(): string
    {
        return $_ENV['COMPANY_NAME'];
    }

    public static function getCompanyFoundingDate(): string
    {
        return $_ENV['COMPANY_FOUNDING_DATE'];
    }

    public static function getEmailInfo(): string
    {
        return $_ENV['MAIL_INFO'];
    }

    public static function getEmailSupport(): string
    {
        return $_ENV['MAIL_SUPPORT'];
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
