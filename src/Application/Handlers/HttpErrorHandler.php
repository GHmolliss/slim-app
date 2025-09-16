<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Actions\API\ActionError;
use App\Application\Actions\API\ActionPayload;
use App\Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpNotImplementedException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Handlers\ErrorHandler as SlimErrorHandler;
use Throwable;

class HttpErrorHandler extends SlimErrorHandler
{
    /**
     * @inheritdoc
     */
    protected function respond(): Response
    {
        $exception = $this->exception;
        $statusCode = 500;

        if ($this->isApiRequest()) {
            $payload = [
                'status' => false,
                'errors' => [],
            ];

            if ($exception instanceof Exception) {
                $statusCode = $exception->getStatusCode();

                foreach ($exception->getErrors() as $error) {
                    $payload['errors'][] = [
                        'id' => $error->id,
                        'code' => $error->code,
                        'message' => $error->message,
                        'propertyPath' => $error->propertyPath,
                    ];
                }

                if (empty($payload['errors'])) {
                    $payload['errors'][] = [
                        'id' => $exception->getId(),
                        'code' => $exception->getCode(),
                        'message' => $exception->getMessage(),
                    ];
                }

                if ($this->displayErrorDetails) {
                    $payload['file'] = $exception->getFile();
                    $payload['line'] = $exception->getLine();
                    $payload['trace'] = $exception->getTrace();
                }
            }

            $encodedPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);

            $response = $this->responseFactory->createResponse($statusCode);
            $response->getBody()->write($encodedPayload);

            return $response->withHeader('Content-Type', 'application/json');
        }

        $error = new ActionError(
            ActionError::SERVER_ERROR,
            'An internal error has occurred while processing your request.'
        );

        if ($exception instanceof HttpException) {
            $statusCode = $exception->getCode();
            $error->setDescription($exception->getMessage());

            if ($exception instanceof HttpNotFoundException) {
                $error->setType(ActionError::RESOURCE_NOT_FOUND);
            } elseif ($exception instanceof HttpMethodNotAllowedException) {
                $error->setType(ActionError::NOT_ALLOWED);
            } elseif ($exception instanceof HttpUnauthorizedException) {
                $error->setType(ActionError::UNAUTHENTICATED);
            } elseif ($exception instanceof HttpForbiddenException) {
                $error->setType(ActionError::INSUFFICIENT_PRIVILEGES);
            } elseif ($exception instanceof HttpBadRequestException) {
                $error->setType(ActionError::BAD_REQUEST);
            } elseif ($exception instanceof HttpNotImplementedException) {
                $error->setType(ActionError::NOT_IMPLEMENTED);
            }
        }

        if (
            !($exception instanceof HttpException)
            && $exception instanceof Throwable
            && $this->displayErrorDetails
        ) {
            $error->setDescription($exception->getMessage());
        }

        $payload = new ActionPayload($statusCode, null, $error);
        $encodedPayload = json_encode($payload, JSON_PRETTY_PRINT);

        $response = $this->responseFactory->createResponse($statusCode);
        $response->getBody()->write($encodedPayload);

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function isApiRequest(): bool
    {
        $uri = $this->request->getUri()->getPath();

        if (strpos($uri, '/api/') === 0) {
            return true;
        }

        return false;
    }
}
