<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\Doctrine\UserRepository')]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "name_last", type: "string", nullable: true)]
    private ?string $nameLast = null;

    #[ORM\Column(name: "name_first", type: "string")]
    private string $nameFirst;

    #[ORM\Column(name: "name_middle", type: "string", nullable: true)]
    private ?string $nameMiddle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameLast(): ?string
    {
        return $this->nameLast;
    }

    public function getNameFirst(): string
    {
        return $this->nameFirst;
    }

    public function getNameMiddle(): ?string
    {
        return $this->nameMiddle;
    }
}
