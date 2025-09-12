<?php

declare(strict_types=1);

namespace App;

final class Error
{
    public function __construct(
        public readonly string $message,
        public readonly ?string $propertyPath = null,
        public readonly int $code = 0,
        public readonly ?int $id = null,
    ) {}

    // public function toArray(): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'code' => $this->code,
    //         'message' => $this->message,
    //         'propertyPath' => $this->propertyPath,
    //     ];
    // }
}
