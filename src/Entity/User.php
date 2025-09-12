<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $lastName;

    #[ORM\Column(type: "string")]
    private string $firstName;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $middleName = null;
}
