<?php

declare(strict_types=1);

namespace App\Repository\Doctrine;

use App\Entity\UserRole;

/**
 * @method ?UserRole find($id, $lockMode = null, $lockVersion = null)
 * @method ?UserRole findOneBy(array $criteria, array $orderBy = null)
 * @method UserRole[] findAll()
 * @method UserRole[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRoleRepository extends Repository {}
