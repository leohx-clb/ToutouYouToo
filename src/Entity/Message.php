<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
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
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMessage;

    /**
     * @ORM\ManyToOne(targetEntity=Demand::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demand;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMessage::class, inversedBy="messagesType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeMessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getDemand(): ?Demand
    {
        return $this->demand;
    }

    public function setDemand(?Demand $demand): self
    {
        $this->demand = $demand;

        return $this;
    }

    public function getTypeMessage(): ?TypeMessage
    {
        return $this->typeMessage;
    }

    public function setTypeMessage(?TypeMessage $typeMessage): self
    {
        $this->typeMessage = $typeMessage;

        return $this;
    }
}
