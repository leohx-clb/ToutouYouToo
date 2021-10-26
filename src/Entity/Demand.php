<?php

namespace App\Entity;

use App\Repository\DemandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandRepository::class)
 */
class Demand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDemand;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="demand")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Adopting::class, inversedBy="demands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adopting;

    /**
     * @ORM\ManyToOne(targetEntity=ad::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ad;

    /**
     * @ORM\ManyToMany(targetEntity=dog::class, inversedBy="demands")
     */
    private $dogs;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->dogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemand(): ?\DateTimeInterface
    {
        return $this->dateDemand;
    }

    public function setDateDemand(\DateTimeInterface $dateDemand): self
    {
        $this->dateDemand = $dateDemand;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setDemand($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDemand() === $this) {
                $message->setDemand(null);
            }
        }

        return $this;
    }

    public function getAdopting(): ?Adopting
    {
        return $this->adopting;
    }

    public function setAdopting(?Adopting $adopting): self
    {
        $this->adopting = $adopting;

        return $this;
    }

    public function getAd(): ?ad
    {
        return $this->ad;
    }

    public function setAd(?ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * @return Collection|dog[]
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs[] = $dog;
        }

        return $this;
    }

    public function removeDog(dog $dog): self
    {
        $this->dogs->removeElement($dog);

        return $this;
    }
}
