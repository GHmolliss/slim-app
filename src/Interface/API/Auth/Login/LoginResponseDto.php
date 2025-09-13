<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\Interface\API\ApiResponseDto;

final class LoginResponseDto extends ApiResponseDto
{
    public function __construct(
        private string $token,
    ) {}

    public function toArray(): array
    {
        return ['token' => $this->token];
    }
}
