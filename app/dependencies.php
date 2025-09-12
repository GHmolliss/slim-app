<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Helpers\PathHelper;
use App\Helpers\SessionHelper;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
    ]);

    $containerBuilder->addDefinitions([
        Twig::class => function () {
            $twig = Twig::create(PathHelper::getTemplatesTwigPath(), ['cache' => PathHelper::getCacheTwigPath()]);
            $twig->getEnvironment()->addGlobal('csrf_token', SessionHelper::getCsrfToken());

            return $twig;
        },
    ]);

    $containerBuilder->addDefinitions([
        EntityManagerInterface::class => function () {
            $entityManager = require __DIR__ . '/doctrine.php';

            return $entityManager();
        },
    ]);
};
