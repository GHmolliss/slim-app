<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Register;

use App\Interface\API\ApiRequestDto;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ApiRegisterRequestDto extends ApiRequestDto
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const LAST_NAME = 'lastName';

    protected function setDefaultFields(): void
    {
        $this->fields = [
            self::EMAIL => null,
            self::PASSWORD => null,
            self::LAST_NAME => null,
        ];
    }

    public static function fromRequest(Request $request): self
    {
        $input = (array) $request->getParsedBody();

        return new self($input);
    }
}
