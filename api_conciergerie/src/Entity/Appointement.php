<?php

namespace App\Entity;

use App\Repository\AppointementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointementRepository::class)]
class Appointement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $scheduleAt = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'clientAppointements')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?User $client = null;

    #[ORM\ManyToOne(inversedBy: 'conciergeAppointements')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?User $concierge = null;

    #[ORM\ManyToOne(inversedBy: 'appointements')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Vehicle $vehicule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScheduleAt(): ?\DateTime
    {
        return $this->scheduleAt;
    }

    public function setScheduleAt(\DateTime $scheduleAt): static
    {
        $this->scheduleAt = $scheduleAt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getConcierge(): ?User
    {
        return $this->concierge;
    }

    public function setConcierge(?User $concierge): static
    {
        $this->concierge = $concierge;

        return $this;
    }

    public function getVehicule(): ?Vehicle
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicle $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
