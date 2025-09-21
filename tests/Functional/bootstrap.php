
<?php

require __DIR__ . '/../../vendor/autoload.php';

use Slim\App;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

function createSlimApp(): App
{
    $containerBuilder = new ContainerBuilder();

    // Set up settings
    $settings = require __DIR__ . '/../../app/settings.php';
    $settings($containerBuilder);

    // Set up dependencies
    $dependencies = require __DIR__ . '/../../app/dependencies.php';
    $dependencies($containerBuilder);

    $container = $containerBuilder->build();
    AppFactory::setContainer($container);
    $app = AppFactory::create();

    // Register middleware
    $middleware = require __DIR__ . '/../../app/middleware.php';
    $middleware($app);

    // Register routes
    $routes = require __DIR__ . '/../../app/routes.php';
    $routes($app);

    // Register API routes
    $routes = require __DIR__ . '/../../app/routes_api.php';
    $routes($app);

    return $app;
}
