<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

class AuthTokenAction extends AuthAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $input = $this->getFormData();

        $clientId = (int) $input['clientId'] ?? null;
        $clientSecret = $input['clientSecret'] ?? null;

        $this->logger->info("Client of id `{$clientId}` was viewed.");

        $secretKey = $_ENV['JWT_SECRET'] ?: null;

        $payload = [
            'iss' => $clientId,
            'aud' => 'service-b',
            'iat' => time(),
            'exp' => time() + 300,
            'role' => 'service'
        ];

        $jwt = JWT::encode($payload, $secretKey, 'HS256');

        return $this->respondWithData([
            'token' => $jwt,
        ]);
    }
}
