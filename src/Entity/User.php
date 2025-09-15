<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\Doctrine\UserRepository')]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(name: "first_name", type: "string")]
    private string $firstName;

    #[ORM\Column(name: "last_name", type: "string", nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(name: "middle_name", type: "string", nullable: true)]
    private ?string $middleName = null;

    #[ORM\Column(name: "email", type: "string", nullable: true)]
    private ?string $email = null;

    #[ORM\Column(name: "password", type: "string", nullable: true)]
    private string $password;

    #[ORM\Column(name: "token", type: "string", length: 56, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(name: "active_email", type: "datetime", nullable: true)]
    private ?DateTime $activeEmail = null;

    #[ORM\Column(name: "active_password", type: "datetime", nullable: true)]
    private ?DateTime $activePassword = null;

    #[ORM\Column(name: "created", type: "datetime")]
    private DateTime $created;

    #[ORM\Column(name: "updated", type: "datetime")]
    private DateTime $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getActiveEmail(): ?DateTime
    {
        return $this->activeEmail;
    }

    public function getActivePassword(): ?DateTime
    {
        return $this->activePassword;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    public function setUpdated(): void
    {
        $this->updated = new DateTime();
    }
}
