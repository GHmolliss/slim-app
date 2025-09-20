<?php

declare(strict_types=1);

namespace App\Domain\User\Auth;

use App\Domain\Builder;
use App\Domain\Contact\Owner\ContactOwnerFacade;
use App\Domain\User\Auth\UseCases\UserAuthManager;
use App\Domain\User\Role\UserRoleFacade;
use App\Entity\User;
use App\Repository\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserAuthBuilder extends Builder
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected UserRoleFacade $userRoleFacade,
        protected ContactOwnerFacade $contactOwnerFacade,
    ) {}

    protected function buildUserAuthManager(): UserAuthManager
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class);

        return new UserAuthManager(
            $this->entityManager,
            $this->userRoleFacade,
            $this->contactOwnerFacade,
            $userRepository,
        );
    }
}
