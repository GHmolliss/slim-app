<?php

declare(strict_types=1);

namespace Tests;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineConnection
{
    public static function getEntityManager(): EntityManagerInterface
    {
        $factory = require __DIR__ . '/../app/doctrine.php';

        return $factory();
    }
}
