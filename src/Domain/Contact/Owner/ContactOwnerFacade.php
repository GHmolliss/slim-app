<?php

declare(strict_types=1);

namespace App\Domain\Contact\Owner;

use App\Entity\ContactOwner;

final class ContactOwnerFacade extends ContactOwnerBuilder
{
    public function getForUser(): ContactOwner
    {
        return $this->buildContactOwnerManager()->getForUser();
    }
}
