<?php

declare(strict_types=1);

namespace App\Interface\API;

interface ApiInterface
{
    public function get(ApiRequestDto $requestDto): ?ApiResponseDto;
}
