<?php

declare(strict_types=1);

use App\Application\Actions\Auth\AuthLoginAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/api/auth', function (Group $group) {
        $group->post('/login', AuthLoginAction::class);
    });
};
