<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\DomainException\DomainException;
use Fig\Http\Message\StatusCodeInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

abstract class ValidateValueObject
{
    abstract protected function getConstraints(): Collection;

    public function __construct(
        mixed $value,
        protected string $key,
    ) {
        $this->validate($value);
    }

    private function validate(mixed $value): void
    {
        $validator = Validation::createValidator();

        $input = [$this->key => $value];
        $constraints = $this->getConstraints();

        $violationList = $validator->validate($input, $constraints);

        if (!$violationList->has(0)) {
            return;
        }

        $violation = $violationList->get(0);

        throw new DomainException(
            "{$violation->getPropertyPath()}: {$violation->getMessage()}",
            0,
            StatusCodeInterface::STATUS_BAD_REQUEST,
        );
    }
}
