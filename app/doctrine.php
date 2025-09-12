<?php

declare(strict_types=1);

use App\Helpers\EnvHelper;
use App\Helpers\PathHelper;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

return function () {
    $paths = [PathHelper::getSrcEntityPath()];
    $isDevMode = EnvHelper::isDev();

    $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
    $config->setProxyDir(PathHelper::getCachePath() . 'doctrine/proxies');
    $config->setProxyNamespace('App\Doctrine\Proxies');
    $config->setAutoGenerateProxyClasses($isDevMode);

    $dbParams = [
        'driver'   => 'pdo_mysql',
        'host'     => $_ENV['MYSQL_HOST'],
        'port'     => $_ENV['MYSQL_PORT'],
        'dbname'   => $_ENV['MYSQL_DATABASE'],
        'user'     => $_ENV['MYSQL_USER'],
        'password' => $_ENV['MYSQL_PASSWORD'],
        'driverOptions' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $_ENV['MYSQL_CHARSET'] . ' COLLATE ' . $_ENV['MYSQL_COLLATION']
        ],
    ];

    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
};