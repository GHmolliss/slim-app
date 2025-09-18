<?php

declare(strict_types=1);

namespace App\Application\Actions\API\Auth;

use App\Application\Actions\API\Action;
use App\Interface\API\Auth\Login\ApiLoginInterface;
use App\Interface\API\Auth\Register\ApiRegisterInterface;
use Psr\Log\LoggerInterface;

abstract class AuthAction extends Action
{
    public function __construct(
        LoggerInterface $logger,
        protected ApiLoginInterface $apiLoginInterface,
        protected ApiRegisterInterface $apiRegisterInterface,
    ) {
        parent::__construct($logger);
    }
}
