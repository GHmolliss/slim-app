<?php

declare(strict_types=1);

namespace App\Domain;

final class DomainExceptionMapper
{
    // public const PagesCreatorManager = 1;

    private const MAPPING = [
        // self::PagesCreatorManager => PagesCreatorManagerException::class,
    ];

    public static function getPathById(int $id): string
    {
        return self::MAPPING[$id];
    }
}
