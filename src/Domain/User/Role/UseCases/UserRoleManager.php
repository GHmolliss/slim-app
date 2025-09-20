<?php

declare(strict_types=1);

namespace App\Domain\User\Role\UseCases;

use App\Entity\UserRole;
use App\Repository\Doctrine\UserRoleRepository;
use Doctrine\ORM\EntityManagerInterface;

final class UserRoleManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRoleRepository $userRoleRepository,
    ) {}

    public function getRoleForUser(): UserRole
    {
        return $this->userRoleRepository->find(UserRole::USER_ID);
    }
}
