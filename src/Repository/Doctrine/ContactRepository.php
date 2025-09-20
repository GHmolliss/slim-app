<?php

declare(strict_types=1);

namespace App\Repository\Doctrine;

use App\Entity\Contact;

/**
 * @method ?Contact find($id, $lockMode = null, $lockVersion = null)
 * @method ?Contact findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[] findAll()
 * @method Contact[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends Repository {}
