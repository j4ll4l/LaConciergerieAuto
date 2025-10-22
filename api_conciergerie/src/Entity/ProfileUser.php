<?php

namespace App\Entity;

use App\Repository\ProfileUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileUserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProfileUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 6)]
    private ?string $postCode = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $bithdate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identityRectroPath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identityVersoPath = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'profileUser')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): static
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBithdate(): ?\DateTime
    {
        return $this->bithdate;
    }

    public function setBithdate(?\DateTime $bithdate): static
    {
        $this->bithdate = $bithdate;

        return $this;
    }

    public function getIdentityRectroPath(): ?string
    {
        return $this->identityRectroPath;
    }

    public function setIdentityRectroPath(?string $identityRectroPath): static
    {
        $this->identityRectroPath = $identityRectroPath;

        return $this;
    }

    public function getIdentityVersoPath(): ?string
    {
        return $this->identityVersoPath;
    }

    public function setIdentityVersoPath(?string $identityVersoPath): static
    {
        $this->identityVersoPath = $identityVersoPath;

        return $this;
    }

    public function getUpdateAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdateAt(?\DateTime $updateAt): static
    {
        $this->updatedAt = $updateAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
