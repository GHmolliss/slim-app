<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class FilePath extends ValidateValueObject
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

    public function validatePath($path, ExecutionContextInterface $context): void
    {
        $path = (string) $path;

        if (!is_file($path)) {
            $context->buildViolation('The specified path is not a file.')
                ->addViolation();
            return;
        }

        if (!file_exists($path)) {
            $context->buildViolation('The file at the specified path was not found.')
                ->addViolation();
            return;
        }

        if (!is_readable($path)) {
            $context->buildViolation('The file at the specified path is not readable.')
                ->addViolation();
            return;
        }
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
}
