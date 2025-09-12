<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class DirPath extends ValidateValueObject
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
                new Type('string'),
                new Regex('/^(\/|[a-zA-Z]:\\\\)/'),
                new Callback([$this, 'validatePath']),
            ],
        ]);
    }

    public function validatePath($path, ExecutionContextInterface $context): void
    {
        $path = (string) $path;

        if (!is_dir($path)) {
            $context->buildViolation('The specified path is not a directory.')
                ->addViolation();
        }
    }
}
