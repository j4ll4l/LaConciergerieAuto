<?php

namespace App\Entity;

use App\Repository\EstimationRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstimationRequestRepository::class)]
class EstimationRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $vehicleDetails = [];

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $clientMessage = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimatedPrice = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'clientEstimationRequests')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?User $client = null;

    #[ORM\ManyToOne(inversedBy: 'conciergeEstimationRequests')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?User $concierge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicleDetails(): array
    {
        return $this->vehicleDetails;
    }

    public function setVehicleDetails(array $vehicleDetails): static
    {
        $this->vehicleDetails = $vehicleDetails;

        return $this;
    }

    public function getClientMessage(): ?string
    {
        return $this->clientMessage;
    }

    public function setClientMessage(?string $clientMessage): static
    {
        $this->clientMessage = $clientMessage;

        return $this;
    }

    public function getEstimatedPrice(): ?int
    {
        return $this->estimatedPrice;
    }

    public function setEstimatedPrice(?int $estimatedPrice): static
    {
        $this->estimatedPrice = $estimatedPrice;

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
}
