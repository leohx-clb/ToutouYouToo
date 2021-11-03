<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdRepository::class)
 */
class Ad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $dateUpdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Dog::class, mappedBy="ad", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dogs;

    /**
     * @ORM\ManyToOne(targetEntity=Marketer::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Marketer $marketer;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isProvide = false;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="ad")
     */
    private $pictures;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(\DateTimeInterface $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Dog[]
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(Dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs[] = $dog;
            $dog->setAd($this);
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        if ($this->dogs->removeElement($dog)) {
            // set the owning side to null (unless already changed)
            if ($dog->getAd() === $this) {
                $dog->setAd(null);
            }
        }

        return $this;
    }

    public function getMarketer(): ?Marketer
    {
        return $this->marketer;
    }

    public function setMarketer(?Marketer $marketer): self
    {
        $this->marketer = $marketer;

        return $this;
    }

    public function getIsProvide(): ?bool
    {
        return $this->isProvide;
    }

    public function setIsProvide(?bool $isProvide): self
    {
        $this->isProvide = $isProvide;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setAd($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getAd() === $this) {
                $picture->setAd(null);
            }
        }

        return $this;
    }
}
