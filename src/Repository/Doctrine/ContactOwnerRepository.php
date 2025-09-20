<?php

declare(strict_types=1);

namespace App\Repository\Doctrine;

use App\Entity\ContactOwner;

/**
 * @method ?ContactOwner find($id, $lockMode = null, $lockVersion = null)
 * @method ?ContactOwner findOneBy(array $criteria, array $orderBy = null)
 * @method ContactOwner[] findAll()
 * @method ContactOwner[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactOwnerRepository extends Repository {}
