<?php

declare(strict_types=1);

namespace App\Interface\API\Auth\Login;

use App\Interface\API\ApiRequestDto;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ApiLoginRequestDto extends ApiRequestDto
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    protected function setDefaultFields(): void
    {
        $this->fields = [
            self::EMAIL => null,
            self::PASSWORD => null,
        ];
    }

    public static function fromRequest(Request $request): self
    {
        $input = (array) $request->getParsedBody();

        return new self($input);
    }
}
