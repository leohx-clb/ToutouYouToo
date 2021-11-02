<?php

namespace App\Entity;

use App\Repository\DogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DogRepository::class)
 */
class Dog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="dog", orphanRemoval=true,cascade={"persist", "remove"})
     * @Assert\Count(
     *     min = 1,
     *     max = 5,
     *     minMessage = "Selectionnez au moins une photo",
     *     maxMessage = "Vous ne pouvez ajouter qu'au maximum 5 photos")
     */
    private Collection $pictures;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)

     *
     */
    private ?string $history;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $lof;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La description ne peut pas être vide")
     * @Assert\Length(
     *     min="20",
     *     max="255",
     *     minMessage="La description doit comporter au moins 20 caractéres",
     *     maxMessage="La description ne doit pas comporter au plus 255 caractéres")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $animalsFriendly;

    /**
     * @ORM\ManyToMany(targetEntity=Race::class, inversedBy="dogs")
     * @Assert\Count(
     *     min = 1,
     *     max = 4,
     *     minMessage = "Selectionnez au moins une race",
     *     maxMessage = "You cannot specify more than {{ limit }} emails"
     *
     * )
     */
    private Collection $races;

    /**
     * @ORM\ManyToOne(targetEntity=Ad::class, inversedBy="dogs")
     */
    private ?Ad $ad;

    /**
     * @ORM\ManyToMany(targetEntity=Demand::class, mappedBy="dogs")
     */
    private Collection $demands;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le nom doit comporter au moins 3 caractéres",
     *     maxMessage="Le nom ne doit pas comporter au plus 50 caractéres")
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Le sexe doit être renseigné male/femelle/inconnu")
     * @Assert\Length(
     *     min="4",
     *     max="8",
     *     minMessage="Le nom doit comporter au moins 4 caractéres",
     *     maxMessage="Le nom ne doit pas comporter au plus 50 caractéres")
     */
    private ?string $sex;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->races = new ArrayCollection();
        $this->demands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $picture->setDog($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getDog() === $this) {
                $picture->setDog(null);
            }
        }

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getLof(): ?bool
    {
        return $this->lof;
    }

    public function setLof(bool $lof): self
    {
        $this->lof = $lof;

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

    public function getAnimalsFriendly(): ?bool
    {
        return $this->animalsFriendly;
    }

    public function setAnimalsFriendly(bool $animalsFriendly): self
    {
        $this->animalsFriendly = $animalsFriendly;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        $this->races->removeElement($race);

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * @return Collection|Demand[]
     */
    public function getDemands(): Collection
    {
        return $this->demands;
    }

    public function addDemand(Demand $demand): self
    {
        if (!$this->demands->contains($demand)) {
            $this->demands[] = $demand;
            $demand->addDog($this);
        }

        return $this;
    }

    public function removeDemand(Demand $demand): self
    {
        if ($this->demands->removeElement($demand)) {
            $demand->removeDog($this);
        }

        return $this;
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

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }
}
