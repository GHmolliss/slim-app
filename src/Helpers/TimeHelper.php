<?php

declare(strict_types=1);

namespace App\Helpers;

use LogicException;

final class TimeHelper
{
    public static function timeToStr(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds - $hours * 3600) / 60);
        $seconds = $seconds - $hours * 3600 - $minutes * 60;

        $times = [];

        if ($hours > 0) {
            $times[] = $hours . ' ч';
        }

        if ($minutes > 0) {
            $times[] = $minutes . ' мин';
        }

        $shortTimes = array_slice($times, 0, 2);

        if (count($shortTimes) > 0) {
            return implode(' ', $shortTimes);
        }

        return $seconds . ' сек';
    }

    public static function calculateTaskTime(int $difficultyLevel): int
    {
        switch ($difficultyLevel) {
            case 1:
                return 60;
            default:
                throw new LogicException('Unknown difficulty level');
        }
    }
}
