<?php

namespace App\Entity;

use App\Repository\MarketerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarketerRepository::class)
 */
class Marketer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMarketer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeMarketer;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="marketer")
     */
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeMarketer(): ?TypeMarketer
    {
        return $this->typeMarketer;
    }

    public function setTypeMarketer(?TypeMarketer $typeMarketer): self
    {
        $this->typeMarketer = $typeMarketer;

        return $this;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setMarketer($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getMarketer() === $this) {
                $ad->setMarketer(null);
            }
        }

        return $this;
    }
}
