<?php

namespace App\Entity;

use App\Repository\TypeMarketerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TypeMarketerRepository::class)
 */
class TypeMarketer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *@Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le nom doit comporter au moins 3 caractéres ",
     *     maxMessage="Le nom ne doit pas comporter au plus 50 caractéres ")
     */
    private $name;

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

    public function __toString(){
        return $this->getName();
    }
}
