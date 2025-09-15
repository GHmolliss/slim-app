<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Login;

use App\Domain\User\Auth\UserAuthFacade;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\UserPassword;
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
            new Email($requestDto->getByKey(ApiLoginRequestDto::EMAIL)),
            new UserPassword($requestDto->getByKey(ApiLoginRequestDto::PASSWORD)),
        );

        return new ApiLoginResponseDto($token);
    }
}
