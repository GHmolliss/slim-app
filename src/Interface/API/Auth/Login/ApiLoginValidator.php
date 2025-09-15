<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Login;

use App\Helpers\ConstraintsHelper;
use App\Interface\API\ApiRequestDto;
use App\Interface\API\ApiValidator;
use Symfony\Component\Validator\Constraints\Collection;

final class ApiLoginValidator extends ApiValidator
{
    public function validateDto(ApiRequestDto $requestDto): void
    {
        $this->fields = $this->getFields($requestDto);

        $this->constraints = new Collection([
            ApiLoginRequestDto::EMAIL => ConstraintsHelper::userEmail(),
            ApiLoginRequestDto::PASSWORD => ConstraintsHelper::userPassword(),
        ]);

        $this->violationHandler();
    }

    protected function getFields(ApiRequestDto $requestDto): array
    {
        return [
            ApiLoginRequestDto::EMAIL => $requestDto->getByKey(ApiLoginRequestDto::EMAIL),
            ApiLoginRequestDto::PASSWORD => $requestDto->getByKey(ApiLoginRequestDto::PASSWORD),
        ];
    }

    protected function getConstraints(): Collection
    {
        return new Collection();
    }
}
