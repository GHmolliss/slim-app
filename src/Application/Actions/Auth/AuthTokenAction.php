<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Helpers\JwtHelper;
use Psr\Http\Message\ResponseInterface as Response;

class AuthTokenAction extends AuthAction
{
    protected function action(): Response
    {
        $input = $this->getFormData();
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        // Пример простой проверки (замените на свою логику)
        if ($email === 'admin' && $password === 'password') {
            $payload = [
                'sub' => $email,
                // можно добавить другие данные
            ];
            $token = JwtHelper::generateToken($payload);

            $responseData = ['token' => $token];
            $response = $this->respondWithData($responseData);
            return $response->withHeader('Content-Type', 'application/json');
        }

        return $this->respondWithData(['error' => 'Invalid credentials'], 401)
            ->withHeader('Content-Type', 'application/json');
    }
}
