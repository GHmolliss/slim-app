<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Entity\User;
use App\Repository\Doctrine\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
    protected EntityManagerInterface $entityManager;
    protected UserRepository $userRepository;

    public function __construct(
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
    ) {
        parent::__construct($logger);

        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository(User::class);
    }
}
