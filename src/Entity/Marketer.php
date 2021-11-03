<?php

namespace App\Entity;

use App\Repository\MarketerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarketerRepository::class)
 */
class Marketer extends User
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMarketer::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?TypeMarketer $typeMarketer;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="marketer")
     */
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
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

    public function countAdsValided (){
        // METHODE A METTRE EN PLACE TICKET 64
        //methode pour count le nombre d'annonce valider
        //ajouter le boolean dans ad pour conter le nombre valider
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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = parent::getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_MARKETER';

        return array_unique($roles);
    }
}
