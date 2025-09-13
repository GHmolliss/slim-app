<?php

declare(strict_types=1);

namespace App\Interface\API;

abstract class ApiResponseDto
{
    abstract public function toArray(): array;
}
