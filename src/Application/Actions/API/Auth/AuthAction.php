<?php

declare(strict_types=1);

namespace App\Application\Actions\API\Auth;

use App\Application\Actions\API\Action;
use App\Interface\API\Auth\Login\ApiLoginInterface;
use Psr\Log\LoggerInterface;

abstract class AuthAction extends Action
{
    public function __construct(
        LoggerInterface $logger,
        protected ApiLoginInterface $apiLoginInterface,
    ) {
        parent::__construct($logger);
    }
}
