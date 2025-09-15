<?php

declare(strict_types=1);

namespace App\Domain\User\Auth;

use App\Domain\Builder;
use App\Domain\User\Auth\UseCases\UserAuthManager;
use App\Entity\User;
use App\Repository\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserAuthBuilder extends Builder
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    protected function buildUserAuthManager(): UserAuthManager
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);

        return new UserAuthManager(
            $this->entityManager,
            $userRepository,
        );
    }
}
