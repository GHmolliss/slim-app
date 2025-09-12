<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;

class NumberPositiveNullable extends ValidateValueObject
{
    protected ?int $value;

    public function __construct(
        mixed $value,
        protected string $key,
    ) {
        parent::__construct($value, $key);

        $this->value = $value;
    }

    public function get(): ?int
    {
        return $this->value;
    }

    protected function getConstraintsInput(array $params): array
    {
        return [
            $this->key => $params['value'] ?? null,
        ];
    }

    protected function getConstraints(): Collection
    {
        return new Collection([
            $this->key => [
                new Type('int'),
                new Positive(),
            ],
        ]);
    }
}