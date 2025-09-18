<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Register;

use App\Domain\User\Auth\UserAuthFacade;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\UserLastName;
use App\Domain\ValueObjects\UserPassword;
use App\Interface\API\ApiInterface;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiResponseDto;

final class ApiRegisterInterface implements ApiInterface
{
    public function __construct(
        private ApiRegisterValidator $validator,
        private UserAuthFacade $userAuthFacade,
    ) {}

    public function get(ApiRequestDto $requestDto): ?ApiResponseDto
    {
        $this->validator->validateDto($requestDto);

        $userLastName = new UserLastName($requestDto->getByKey(ApiRegisterRequestDto::LAST_NAME));
        $email = new Email($requestDto->getByKey(ApiRegisterRequestDto::EMAIL));
        $password = new UserPassword($requestDto->getByKey(ApiRegisterRequestDto::PASSWORD));

        $userId = $this->userAuthFacade->register(
            $userLastName,
            $email,
            $password,
        );

        return new ApiRegisterResponseDto($userId);
    }
}
