<?php

declare(strict_types=1);

namespace App\Application\Actions\API\Auth;

use App\Interface\API\Auth\Register\ApiRegisterRequestDto;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;

class AuthRegisterAction extends AuthAction
{
    protected function action(): Response
    {
        $requestDto = ApiRegisterRequestDto::fromRequest($this->request);

        $responseDto = $this->apiRegisterInterface->get($requestDto);

        return $this->respondWithData(
            $responseDto->toArray(),
            StatusCodeInterface::STATUS_CREATED,
        );
    }
}
