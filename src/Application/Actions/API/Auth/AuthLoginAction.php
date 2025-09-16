<?php

declare(strict_types=1);

namespace App\Application\Actions\API\Auth;

use App\Interface\API\Auth\Login\ApiLoginRequestDto;
use Psr\Http\Message\ResponseInterface as Response;

class AuthLoginAction extends AuthAction
{
    protected function action(): Response
    {
        $requestDto = ApiLoginRequestDto::fromRequest($this->request);

        $responseDto = $this->apiLoginInterface->get($requestDto);

        return $this->respondWithData($responseDto->toArray());
    }
}
