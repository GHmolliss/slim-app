<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class Md5 extends ValidateValueObject
{
    protected string $value;

    public function __construct(
        mixed $value,
        protected string $key,
    ) {
        parent::__construct($key, $value);

        $this->value = $value;
    }

    public function get(): string
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
                new NotBlank(),
                new Regex([
                    'pattern' => "/^[a-f0-9]{32}$/i",
                ]),
            ],
        ]);
    }
}
