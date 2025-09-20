<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: 'App\Repository\Doctrine\ContactOwnerRepository')]
#[ORM\Table(name: 'contacts')]
class ContactOwner
{
    use TimestampableEntity;

    public const USER_ID = 1;

    #[ORM\Id]
    #[ORM\Column(name: "id", type: 'integer', options: ['unsigned' => true, 'comment' => 'Id'])]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;


    #[ORM\Column(name: "name", type: "string", length: 25)]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
