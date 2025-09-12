<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class HttpUserAgent extends ValidateValueObject
{
    protected string $value;

    public function __construct(
        mixed $value,
        protected string $key,
    ) {
        parent::__construct($value, $key);

        $this->value = $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    protected function getConstraints(): Collection
    {
        return new Collection([
            $this->key => [
                new NotBlank(),
                new Type('string'),
            ],
        ]);
    }
}
