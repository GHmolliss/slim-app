<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;
use App\Helpers\JwtHelper;
use Throwable;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        try {
            $authHeader = $request->getHeaderLine('Authorization');

            $token = JwtHelper::getBearerToken($authHeader);
            $payload = JwtHelper::getPayloadByToken($token);

            $request = $request->withAttribute('user', $payload);
        } catch (Throwable $e) {
            $response = new SlimResponse();

            $response->getBody()->write(json_encode([
                'status' => false,
                'errors' => [
                    $e->getMessage(),
                ],
            ]));

            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }
}
