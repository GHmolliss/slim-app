<?php

declare(strict_types=1);

namespace App\UseCases\Auth\Login;

use App\Helpers\ConstraintsHelper;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiValidator;
use Symfony\Component\Validator\Constraints\Collection;

final class LoginValidator extends ApiValidator
{
    public function validateDto(ApiRequestDto $requestDto): void
    {
        $this->fields = $this->getFields($requestDto);

        $this->constraints = new Collection([
            LoginRequestDto::EMAIL => ConstraintsHelper::userEmail(),
            LoginRequestDto::PASSWORD => ConstraintsHelper::userPassword(),
        ]);

        $this->violationHandler();
    }

    protected function getFields(ApiRequestDto $requestDto): array
    {
        return [
            LoginRequestDto::EMAIL => $requestDto->getByKey(LoginRequestDto::EMAIL),
            LoginRequestDto::PASSWORD => $requestDto->getByKey(LoginRequestDto::PASSWORD),
        ];
    }

    protected function getConstraints(): Collection
    {
        return new Collection();
    }
}
