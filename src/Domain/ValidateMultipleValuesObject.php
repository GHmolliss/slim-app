<?php

declare(strict_types=1);

namespace App\Domain;

use LogicException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

abstract class ValidateMultipleValuesObject
{
    abstract protected function getConstraintsInput(array $params): array;
    abstract protected function getConstraints(): Collection;

    public function __construct(array $params)
    {
        $this->validate($params);

        foreach ($params as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new LogicException("Property '{$key}' does not exist in class " . get_class($this));
            }

            $this->{$key} = $value;
        }
    }

    protected function validate(array $params): void
    {
        $validator = Validation::createValidator();

        $input = $this->getConstraintsInput($params);
        $constraints = $this->getConstraints();

        $violationList = $validator->validate($input, $constraints);

        if (!$violationList->has(0)) {
            return;
        }

        $violation = $violationList->get(0);

        throw new DomainException(
            "{$violation->getPropertyPath()}: {$violation->getMessage()}",
            0,
            Response::HTTP_BAD_REQUEST,
        );
    }
}
