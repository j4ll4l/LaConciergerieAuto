<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'sellerVehicles')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?User $seller = null;

    #[ORM\ManyToOne(inversedBy: 'ManagedVehicules')]
    #[ORM\JoinColumn(nullable: false, onDelete: "RESTRICT")]
    private ?User $concierge = null;

    /**
     * @var Collection<int, VehiclePhoto>
     */
    #[ORM\OneToMany(targetEntity: VehiclePhoto::class, mappedBy: 'vehicle', orphanRemoval: true)]
    private Collection $vehiclePhotos;

    /**
     * @var Collection<int, VehicleStatusHistory>
     */
    #[ORM\OneToMany(targetEntity: VehicleStatusHistory::class, mappedBy: 'vehicle', orphanRemoval: true)]
    private Collection $vehicleStatusHistories;

    /**
     * @var Collection<int, Appointement>
     */
    #[ORM\OneToMany(targetEntity: Appointement::class, mappedBy: 'vehicule')]
    private Collection $appointements;

    #[ORM\OneToOne(mappedBy: 'vehicle', cascade: ['persist', 'remove'])]
    private ?Transaction $transaction = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->vehiclePhotos = new ArrayCollection();
        $this->vehicleStatusHistories = new ArrayCollection();
        $this->appointements = new ArrayCollection();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getSeller(): ?User
    {
        return $this->seller;
    }

    public function setSeller(?User $seller): static
    {
        $this->seller = $seller;

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

    /**
     * @return Collection<int, VehiclePhoto>
     */
    public function getVehiclePhotos(): Collection
    {
        return $this->vehiclePhotos;
    }

    public function addVehiclePhoto(VehiclePhoto $vehiclePhoto): static
    {
        if (!$this->vehiclePhotos->contains($vehiclePhoto)) {
            $this->vehiclePhotos->add($vehiclePhoto);
            $vehiclePhoto->setVehicle($this);
        }

        return $this;
    }

    public function removeVehiclePhoto(VehiclePhoto $vehiclePhoto): static
    {
        if ($this->vehiclePhotos->removeElement($vehiclePhoto)) {
            // set the owning side to null (unless already changed)
            if ($vehiclePhoto->getVehicle() === $this) {
                $vehiclePhoto->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VehicleStatusHistory>
     */
    public function getVehicleStatusHistories(): Collection
    {
        return $this->vehicleStatusHistories;
    }

    public function addVehicleStatusHistory(VehicleStatusHistory $vehicleStatusHistory): static
    {
        if (!$this->vehicleStatusHistories->contains($vehicleStatusHistory)) {
            $this->vehicleStatusHistories->add($vehicleStatusHistory);
            $vehicleStatusHistory->setVehicle($this);
        }

        return $this;
    }

    public function removeVehicleStatusHistory(VehicleStatusHistory $vehicleStatusHistory): static
    {
        if ($this->vehicleStatusHistories->removeElement($vehicleStatusHistory)) {
            // set the owning side to null (unless already changed)
            if ($vehicleStatusHistory->getVehicle() === $this) {
                $vehicleStatusHistory->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointement>
     */
    public function getAppointements(): Collection
    {
        return $this->appointements;
    }

    public function addAppointement(Appointement $appointement): static
    {
        if (!$this->appointements->contains($appointement)) {
            $this->appointements->add($appointement);
            $appointement->setVehicule($this);
        }

        return $this;
    }

    public function removeAppointement(Appointement $appointement): static
    {
        if ($this->appointements->removeElement($appointement)) {
            // set the owning side to null (unless already changed)
            if ($appointement->getVehicule() === $this) {
                $appointement->setVehicule(null);
            }
        }

        return $this;
    }

    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    public function setTransaction(Transaction $transaction): static
    {
        // set the owning side of the relation if necessary
        if ($transaction->getVehicle() !== $this) {
            $transaction->setVehicle($this);
        }

        $this->transaction = $transaction;

        return $this;
    }
}
