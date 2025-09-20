<?php

declare(strict_types=1);

namespace App\Domain\User\Role;

use App\Domain\Builder;
use App\Domain\User\Role\UseCases\UserRoleManager;
use App\Entity\UserRole;
use App\Repository\Doctrine\UserRoleRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserRoleBuilder extends Builder
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    protected function buildUserRoleManager(): UserRoleManager
    {
        /** @var UserRoleRepository $userRoleRepository */
        $userRoleRepository = $this->entityManager->getRepository(UserRole::class);

        return new UserRoleManager(
            $this->entityManager,
            $userRoleRepository,
        );
    }
}
