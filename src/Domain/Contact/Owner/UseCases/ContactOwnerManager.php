<?php

declare(strict_types=1);

namespace App\Domain\Contact\Owner\UseCases;

use App\Entity\ContactOwner;
use App\Repository\Doctrine\ContactOwnerRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ContactOwnerManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ContactOwnerRepository $contactOwnerRepository,
    ) {}

    public function getForUser(): ContactOwner
    {
        return $this->contactOwnerRepository->find(ContactOwner::USER_ID);
    }
}
