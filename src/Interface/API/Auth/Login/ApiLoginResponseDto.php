<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Login;

use App\Interface\API\ApiResponseDto;

final class ApiLoginResponseDto extends ApiResponseDto
{
    public function __construct(
        private string $token,
    ) {}

    public function toArray(): array
    {
        return ['token' => $this->token];
    }
}
