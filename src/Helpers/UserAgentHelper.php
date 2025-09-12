<?php

declare(strict_types=1);

namespace App\Helpers;

final class UserAgentHelper
{
    public static function isBot(?string $userAgent): bool
    {
        if ($userAgent === null) {
            return true;
        }

        $userAgent = strtolower($userAgent);

        if (preg_match('/bot|crawl|spider|bing|slurp|duckduckgo|baidu|yandex|sogou|exabot|facebot|ia_archiver/i', $userAgent)) {
            return true;
        }

        return false;
    }
}
