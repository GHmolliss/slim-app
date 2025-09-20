<?php

declare(strict_types=1);

namespace App\Domain\User\Role;

use App\Entity\UserRole;

final class UserRoleFacade extends UserRoleBuilder
{
    public function getForUser(): UserRole
    {
        return $this->buildUserRoleManager()->getForUser();
    }
}
