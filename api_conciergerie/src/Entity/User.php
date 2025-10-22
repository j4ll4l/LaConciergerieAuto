<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $roles = [];

    #[ORM\Column(length: 80)]
    private ?string $firstName = null;

    #[ORM\Column(length: 80)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?ProfileUser $profileUser = null;

    /**
     * @var Collection<int, Vehicle>
     */
    #[ORM\OneToMany(targetEntity: Vehicle::class, mappedBy: 'seller')]
    private Collection $sellerVehicles;

    /**
     * @var Collection<int, Vehicle>
     */
    #[ORM\OneToMany(targetEntity: Vehicle::class, mappedBy: 'concierge')]
    private Collection $ManagedVehicules;

    /**
     * @var Collection<int, EstimationRequest>
     */
    #[ORM\OneToMany(targetEntity: EstimationRequest::class, mappedBy: 'client')]
    private Collection $clientEstimationRequests;

    /**
     * @var Collection<int, EstimationRequest>
     */
    #[ORM\OneToMany(targetEntity: EstimationRequest::class, mappedBy: 'concierge')]
    private Collection $conciergeEstimationRequests;

    /**
     * @var Collection<int, Appointement>
     */
    #[ORM\OneToMany(targetEntity: Appointement::class, mappedBy: 'client')]
    private Collection $clientAppointements;

    /**
     * @var Collection<int, Appointement>
     */
    #[ORM\OneToMany(targetEntity: Appointement::class, mappedBy: 'concierge')]
    private Collection $conciergeAppointements;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(targetEntity: Transaction::class, mappedBy: 'buyer')]
    private Collection $buyerTransactions;

    /**
     * @var Collection<int, ResetPasswordRequest>
     */
    #[ORM\OneToMany(targetEntity: ResetPasswordRequest::class, mappedBy: 'user')]
    private Collection $resetPasswordRequests;

    public function __construct()
    {
        $this->roles = ['ROLE_CLIENT'];
        $this->createdAt = new \DateTimeImmutable();
        $this->sellerVehicles = new ArrayCollection();
        $this->ManagedVehicules = new ArrayCollection();
        $this->clientEstimationRequests = new ArrayCollection();
        $this->conciergeEstimationRequests = new ArrayCollection();
        $this->clientAppointements = new ArrayCollection();
        $this->conciergeAppointements = new ArrayCollection();
        $this->buyerTransactions = new ArrayCollection();
        $this->resetPasswordRequests = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

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

    public function getProfileUser(): ?ProfileUser
    {
        return $this->profileUser;
    }

    public function setProfileUser(?ProfileUser $profileUser): static
    {
        // unset the owning side of the relation if necessary
        if ($profileUser === null && $this->profileUser !== null) {
            $this->profileUser->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($profileUser !== null && $profileUser->getUser() !== $this) {
            $profileUser->setUser($this);
        }

        $this->profileUser = $profileUser;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getSellerVehicles(): Collection
    {
        return $this->sellerVehicles;
    }

    public function addSellerVehicle(Vehicle $sellerVehicle): static
    {
        if (!$this->sellerVehicles->contains($sellerVehicle)) {
            $this->sellerVehicles->add($sellerVehicle);
            $sellerVehicle->setSeller($this);
        }

        return $this;
    }

    public function removeSellerVehicle(Vehicle $sellerVehicle): static
    {
        if ($this->sellerVehicles->removeElement($sellerVehicle)) {
            // set the owning side to null (unless already changed)
            if ($sellerVehicle->getSeller() === $this) {
                $sellerVehicle->setSeller(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getManagedVehicules(): Collection
    {
        return $this->ManagedVehicules;
    }

    public function addManagedVehicule(Vehicle $managedVehicule): static
    {
        if (!$this->ManagedVehicules->contains($managedVehicule)) {
            $this->ManagedVehicules->add($managedVehicule);
            $managedVehicule->setConcierge($this);
        }

        return $this;
    }

    public function removeManagedVehicule(Vehicle $managedVehicule): static
    {
        if ($this->ManagedVehicules->removeElement($managedVehicule)) {
            // set the owning side to null (unless already changed)
            if ($managedVehicule->getConcierge() === $this) {
                $managedVehicule->setConcierge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EstimationRequest>
     */
    public function getClientEstimationRequests(): Collection
    {
        return $this->clientEstimationRequests;
    }

    public function addClientEstimationRequest(EstimationRequest $clientEstimationRequest): static
    {
        if (!$this->clientEstimationRequests->contains($clientEstimationRequest)) {
            $this->clientEstimationRequests->add($clientEstimationRequest);
            $clientEstimationRequest->setClient($this);
        }

        return $this;
    }

    public function removeClientEstimationRequest(EstimationRequest $clientEstimationRequest): static
    {
        if ($this->clientEstimationRequests->removeElement($clientEstimationRequest)) {
            // set the owning side to null (unless already changed)
            if ($clientEstimationRequest->getClient() === $this) {
                $clientEstimationRequest->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EstimationRequest>
     */
    public function getConciergeEstimationRequests(): Collection
    {
        return $this->conciergeEstimationRequests;
    }

    public function addConciergeEstimationRequest(EstimationRequest $conciergeEstimationRequest): static
    {
        if (!$this->conciergeEstimationRequests->contains($conciergeEstimationRequest)) {
            $this->conciergeEstimationRequests->add($conciergeEstimationRequest);
            $conciergeEstimationRequest->setConcierge($this);
        }

        return $this;
    }

    public function removeConciergeEstimationRequest(EstimationRequest $conciergeEstimationRequest): static
    {
        if ($this->conciergeEstimationRequests->removeElement($conciergeEstimationRequest)) {
            // set the owning side to null (unless already changed)
            if ($conciergeEstimationRequest->getConcierge() === $this) {
                $conciergeEstimationRequest->setConcierge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointement>
     */
    public function getClientAppointements(): Collection
    {
        return $this->clientAppointements;
    }

    public function addClientAppointement(Appointement $clientAppointement): static
    {
        if (!$this->clientAppointements->contains($clientAppointement)) {
            $this->clientAppointements->add($clientAppointement);
            $clientAppointement->setClient($this);
        }

        return $this;
    }

    public function removeClientAppointement(Appointement $clientAppointement): static
    {
        if ($this->clientAppointements->removeElement($clientAppointement)) {
            // set the owning side to null (unless already changed)
            if ($clientAppointement->getClient() === $this) {
                $clientAppointement->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointement>
     */
    public function getConciergeAppointements(): Collection
    {
        return $this->conciergeAppointements;
    }

    public function addConciergeAppointement(Appointement $conciergeAppointement): static
    {
        if (!$this->conciergeAppointements->contains($conciergeAppointement)) {
            $this->conciergeAppointements->add($conciergeAppointement);
            $conciergeAppointement->setConcierge($this);
        }

        return $this;
    }

    public function removeConciergeAppointement(Appointement $conciergeAppointement): static
    {
        if ($this->conciergeAppointements->removeElement($conciergeAppointement)) {
            // set the owning side to null (unless already changed)
            if ($conciergeAppointement->getConcierge() === $this) {
                $conciergeAppointement->setConcierge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getBuyerTransactions(): Collection
    {
        return $this->buyerTransactions;
    }

    public function addBuyerTransaction(Transaction $buyerTransaction): static
    {
        if (!$this->buyerTransactions->contains($buyerTransaction)) {
            $this->buyerTransactions->add($buyerTransaction);
            $buyerTransaction->setBuyer($this);
        }

        return $this;
    }

    public function removeBuyerTransaction(Transaction $buyerTransaction): static
    {
        if ($this->buyerTransactions->removeElement($buyerTransaction)) {
            // set the owning side to null (unless already changed)
            if ($buyerTransaction->getBuyer() === $this) {
                $buyerTransaction->setBuyer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResetPasswordRequest>
     */
    public function getResetPasswordRequests(): Collection
    {
        return $this->resetPasswordRequests;
    }

    public function addResetPasswordRequest(ResetPasswordRequest $resetPasswordRequest): static
    {
        if (!$this->resetPasswordRequests->contains($resetPasswordRequest)) {
            $this->resetPasswordRequests->add($resetPasswordRequest);
            $resetPasswordRequest->setUser($this);
        }

        return $this;
    }

    public function removeResetPasswordRequest(ResetPasswordRequest $resetPasswordRequest): static
    {
        if ($this->resetPasswordRequests->removeElement($resetPasswordRequest)) {
            // set the owning side to null (unless already changed)
            if ($resetPasswordRequest->getUser() === $this) {
                $resetPasswordRequest->setUser(null);
            }
        }

        return $this;
    }
}
