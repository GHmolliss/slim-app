<?php

declare(strict_types=1);

namespace App\Domain\Contact\Owner\Exceptions;

use App\Domain\DomainException\DomainException;
use App\Domain\DomainException\DomainExceptionMapper;

final class ContactOwnerManagerException extends DomainException
{
    protected const ID = DomainExceptionMapper::ContactOwnerManager;
}
