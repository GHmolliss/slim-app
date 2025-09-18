<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Register;

use App\Helpers\ConstraintsHelper;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiValidator;
use Symfony\Component\Validator\Constraints\Collection;

final class ApiRegisterValidator extends ApiValidator
{
    public function validateDto(ApiRequestDto $requestDto): void
    {
        $this->fields = $this->getFields($requestDto);

        $this->constraints = new Collection([
            ApiRegisterRequestDto::EMAIL => ConstraintsHelper::userEmail(),
            ApiRegisterRequestDto::PASSWORD => ConstraintsHelper::userPassword(),
            ApiRegisterRequestDto::LAST_NAME => ConstraintsHelper::userLastName(),
        ]);

        $this->violationHandler();
    }

    protected function getFields(ApiRequestDto $requestDto): array
    {
        return [
            ApiRegisterRequestDto::EMAIL => $requestDto->getByKey(ApiRegisterRequestDto::EMAIL),
            ApiRegisterRequestDto::PASSWORD => $requestDto->getByKey(ApiRegisterRequestDto::PASSWORD),
            ApiRegisterRequestDto::LAST_NAME => $requestDto->getByKey(ApiRegisterRequestDto::LAST_NAME),
        ];
    }

    protected function getConstraints(): Collection
    {
        return new Collection();
    }
}
