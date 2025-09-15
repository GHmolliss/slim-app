<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Login;

use App\Domain\User\Auth\UserAuthFacade;
use App\Interface\API\ApiInterface;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiResponseDto;

final class ApiLoginInterface implements ApiInterface
{
    public function __construct(
        private ApiLoginValidator $validator,
        private UserAuthFacade $userAuthFacade,
    ) {}

    public function get(ApiRequestDto $requestDto): ?ApiResponseDto
    {
        $this->validator->validateDto($requestDto);

        $token = $this->userAuthFacade->login(
            $requestDto->getByKey(ApiLoginRequestDto::EMAIL),
            $requestDto->getByKey(ApiLoginRequestDto::PASSWORD),
        );

        return new ApiLoginResponseDto($token);
    }
}
