<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\ValidateValueObject;
use App\Helpers\ConstraintsHelper;
use Symfony\Component\Validator\Constraints\Collection;

final class Token extends ValidateValueObject
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

    protected function getConstraints(): Collection
    {
        return new Collection([
            $this->key => ConstraintsHelper::authToken(),
        ]);
    }
}
