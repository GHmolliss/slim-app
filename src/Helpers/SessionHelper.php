<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Exception;
use Fig\Http\Message\StatusCodeInterface;

final class SessionHelper
{
    public static function findByKey(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function getCsrfToken(): string
    {
        $token = self::findByKey('csrf_token');

        if ($token === null) {
            $token = bin2hex(random_bytes(32));

            self::set('csrf_token', $token);

            return $token;
        }

        return $token;
    }

    public static function validateCsrfToken(): void
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return;
        }

        $inputCsrfToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        $csrfToken = self::findByKey('csrf_token');

        if ($inputCsrfToken !== $csrfToken) {
            throw new Exception(
                'Invalid CSRF token',
                0,
                StatusCodeInterface::STATUS_FORBIDDEN,
            );
        }
    }

    public static function isRequestTooFrequent(): bool
    {
        $currentTime = time();
        $lastRequestTime = self::findByKey('last_request_time');

        if ($lastRequestTime === null) {
            self::set('last_request_time', $currentTime);

            return false;
        }

        if ($currentTime - $lastRequestTime < 1) {
            return true;
        }

        self::set('last_request_time', $currentTime);

        return false;
    }
}
