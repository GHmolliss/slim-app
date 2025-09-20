<?php

declare(strict_types=1);

namespace App\Domain\DomainException;

use App\Domain\User\Auth\Exceptions\UserAuthManagerException;
use App\Domain\User\Role\Exceptions\UserRoleManagerException;

final class DomainExceptionMapper
{
    public const UserAuthManager = 1;
    public const UserRoleManager = 2;

    private const MAPPING = [
        self::UserAuthManager => UserAuthManagerException::class,
        self::UserRoleManager => UserRoleManagerException::class,
    ];

    public static function getPathById(int $id): string
    {
        return self::MAPPING[$id];
    }
}
