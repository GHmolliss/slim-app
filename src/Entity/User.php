<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\UserLastName;
use App\Domain\ValueObjects\UserPassword;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: 'App\Repository\Doctrine\UserRepository')]
#[ORM\Table(name: "users")]
class User
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\Column(name: "id", type: 'integer', options: ['unsigned' => true, 'comment' => 'Id'])]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;


    #[ORM\ManyToOne(targetEntity: UserRole::class)]
    #[ORM\JoinColumn(name: "role_id", referencedColumnName: "id", nullable: false)]
    private UserRole $role;

    #[ORM\Column(name: "first_name", type: "string", nullable: true, length: 20)]
    private ?string $firstName = null;

    #[ORM\Column(name: "last_name", type: "string", nullable: true, length: 20)]
    private string $lastName;

    #[ORM\Column(name: "middle_name", type: "string", nullable: true, length: 20)]
    private ?string $middleName = null;

    #[ORM\Column(name: "email", type: "string", length: 50)]
    private string $email;

    #[ORM\Column(name: "password", type: "string", length: 60)]
    private string $password;

    #[ORM\Column(name: "token", type: "string", length: 56, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(name: "active_email", type: "datetime", nullable: true)]
    private ?DateTime $activeEmail = null;

    #[ORM\Column(name: "active_password", type: "datetime", nullable: true)]
    private ?DateTime $activePassword = null;

    public function __construct(
        UserRole $role,
        UserLastName $lastName,
        Email $email,
        UserPassword $password,
    ) {
        $this->role = $role;
        $this->lastName = $lastName->get();
        $this->email = $email->get();
        $this->password = $password->get();
    }

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
}
