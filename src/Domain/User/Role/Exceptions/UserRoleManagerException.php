<?php

declare(strict_types=1);

namespace App\Domain\User\Role\Exceptions;

use App\Domain\DomainException\DomainException;
use App\Domain\DomainException\DomainExceptionMapper;

final class UserRoleManagerException extends DomainException
{
    protected const ID = DomainExceptionMapper::UserRoleManager;
}
