<?php

declare(strict_types=1);

namespace App\Repository\Doctrine;

use Doctrine\ORM\EntityRepository;

class Repository extends EntityRepository
{
    public function getTableName(string $className): string
    {
        $classMetadata = $this->getEntityManager()->getClassMetadata($className);

        return $classMetadata->getTableName();
    }
}
