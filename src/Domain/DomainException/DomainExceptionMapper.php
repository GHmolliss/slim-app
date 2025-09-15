<?php

declare(strict_types=1);

namespace App\Domain\DomainException;

use App\Domain\User\Auth\Exceptions\UserAuthManagerException;

final class DomainExceptionMapper
{
    public const UserAuthManager = 1;

    private const MAPPING = [
        self::UserAuthManager => UserAuthManagerException::class,
    ];

    public static function getPathById(int $id): string
    {
        return self::MAPPING[$id];
    }
}
