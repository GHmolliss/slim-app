<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/api/auth', function (Group $group) {
        $group->post('/token', \App\Controllers\AuthController::class . ':login');
    });
};