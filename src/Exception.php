<?php

declare(strict_types=1);

namespace App;

use Fig\Http\Message\StatusCodeInterface;
use RuntimeException;
use Throwable;

class Exception extends RuntimeException
{
    protected const ID = null;

    /** @var Error[] */
    private array $errors = [];

    public function __construct(
        string $message,
        int $code,
        protected int $statusCode = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
        ?string $propertyPath = null,
        private array $headers = [],
        ?Throwable $previous = null,
    ) {
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        if (strlen($message) > 0) {
            $this->addErrorByParams($message, $propertyPath, $code, static::ID);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getId(): ?int
    {
        return static::ID;
    }

    public function addErrorByParams(
        string $message,
        ?string $propertyPath = null,
        int $code = 0,
        ?int $id = null
    ): void {
        $this->errors[] = new Error($message, $propertyPath, $code, $id);
    }

    /**
     * @param Error[] $errors
     */
    public function addErrors(array $errors): void
    {
        foreach ($errors as $error) {
            $this->errors[] = $error;
        }
    }

    /**
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}
