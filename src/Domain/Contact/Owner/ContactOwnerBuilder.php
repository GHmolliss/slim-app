<?php

declare(strict_types=1);

namespace App\Domain\Contact\Owner;

use App\Domain\Builder;
use App\Domain\Contact\Owner\UseCases\ContactOwnerManager;
use App\Entity\ContactOwner;
use App\Repository\Doctrine\ContactOwnerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactOwnerBuilder extends Builder
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    protected function buildContactOwnerManager(): ContactOwnerManager
    {
        /** @var ContactOwnerRepository $contactOwnerRepository */
        $contactOwnerRepository = $this->entityManager->getRepository(ContactOwner::class);

        return new ContactOwnerManager(
            $this->entityManager,
            $contactOwnerRepository,
        );
    }
}
