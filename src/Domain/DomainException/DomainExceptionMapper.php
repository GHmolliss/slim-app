<?php

declare(strict_types=1);

namespace App\Domain\DomainException;

use App\Domain\Contact\Owner\Exceptions\ContactOwnerManagerException;
use App\Domain\User\Auth\Exceptions\UserAuthManagerException;
use App\Domain\User\Role\Exceptions\UserRoleManagerException;

final class DomainExceptionMapper
{
    public const UserAuthManager = 1;
    public const UserRoleManager = 2;
    public const ContactOwnerManager = 3;

    private const MAPPING = [
        self::UserAuthManager => UserAuthManagerException::class,
        self::UserRoleManager => UserRoleManagerException::class,
        self::ContactOwnerManager => ContactOwnerManagerException::class,
    ];

    public static function getPathById(int $id): string
    {
        return self::MAPPING[$id];
    }
}
