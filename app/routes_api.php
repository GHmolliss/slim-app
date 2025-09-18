<?php

declare(strict_types=1);

use App\Application\Actions\API\Auth\AuthLoginAction;
use App\Application\Actions\API\Auth\AuthRegisterAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/api/auth', function (Group $group) {
        $group->post('/login', AuthLoginAction::class);
        $group->post('/register', AuthRegisterAction::class);
    });
};
