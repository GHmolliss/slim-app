<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Register;

use App\Domain\ValueObjects\NumberPositive;
use App\Interface\API\ApiResponseDto;

final class ApiRegisterResponseDto extends ApiResponseDto
{
    public function __construct(
        private NumberPositive $userId,
    ) {}

    public function toArray(): array
    {
        return ['id' => $this->userId->get()];
    }
}
