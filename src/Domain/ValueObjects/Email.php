<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Helpers\ConstraintsHelper;
use App\Helpers\StrHelper;
use Symfony\Component\Validator\Constraints\Collection;

final class Email extends ValidateValueObject
{
    protected string $value;

    public function __construct(
        mixed $value,
        protected string $key = 'email',
    ) {
        parent::__construct($value, $key);

        $this->value = StrHelper::prepareEmail($value);
    }

    public function get(): string
    {
        return $this->value;
    }

    protected function getConstraints(): Collection
    {
        return new Collection([
            $this->key => ConstraintsHelper::userEmail(),
        ]);
    }
}
