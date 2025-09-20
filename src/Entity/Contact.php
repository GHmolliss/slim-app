<?php

declare(strict_types=1);

namespace App\Entity;

use App\Domain\ValueObjects\NumberPositive;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: 'App\Repository\Doctrine\ContactRepository')]
#[ORM\Table(name: 'contacts')]
class Contact
{
    use TimestampableEntity;

    public const TYPE_EMAIL_ID = 1;

    #[ORM\Id]
    #[ORM\Column(name: "id", type: 'integer', options: ['unsigned' => true, 'comment' => 'Id'])]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: ContactOwner::class)]
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    private ContactOwner $owner;

    #[ORM\Column(name: 'source_id', type: 'integer', options: ['comment' => 'Source Id'], nullable: false)]
    private int $sourceId;

    #[ORM\Column(name: 'type_id', type: 'integer', options: ['comment' => 'Type Id'], nullable: false)]
    private int $typeId;

    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Значение'], nullable: false)]
    private string $value;

    public function __construct(
        ContactOwner $owner,
        NumberPositive $sourceId,
        NumberPositive $typeId,
        string $value,
    ) {
        $this->owner = $owner;
        $this->sourceId = $sourceId->get();
        $this->typeId = $typeId->get();

        $this->setValue($value);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ContactOwner
    {
        return $this->owner;
    }

    public function setOwner(ContactOwner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $value = trim($value);

        switch ($this->typeId) {
            case self::TYPE_EMAIL_ID:
                $value = mb_strtolower($value, 'UTF-8');
        }

        $this->value = $value;

        return $this;
    }
}
