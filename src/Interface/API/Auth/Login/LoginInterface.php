<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\Domain\User\Auth\UserAuthFacade;
use App\Interface\API\ApiInterface as APIApiInterface;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiResponseDto;

final class LoginInterface implements APIApiInterface
{
    public function __construct(
        private LoginValidator $validator,
        private UserAuthFacade $userAuthFacade,
    ) {}

    public function get(ApiRequestDto $requestDto): ?ApiResponseDto
    {
        $this->validator->validateDto($requestDto);

        $token = $this->userAuthFacade->login(
            $requestDto->getByKey(LoginRequestDto::EMAIL),
            $requestDto->getByKey(LoginRequestDto::PASSWORD),
        );

        return new LoginResponseDto($token);
    }
}
