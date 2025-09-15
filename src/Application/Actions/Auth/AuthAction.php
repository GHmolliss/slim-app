<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
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
