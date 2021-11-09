<?php

namespace App\Entity;

use App\Repository\TypeMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeMessageRepository::class)
 */
class TypeMessage
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="typeMessage")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="typeMessage")
     */
    private $messagesType;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->messagesType = new ArrayCollection();
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
            $message->setTypeMessage($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getTypeMessage() === $this) {
                $message->setTypeMessage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesType(): Collection
    {
        return $this->messagesType;
    }

    public function addMessagesType(Message $messagesType): self
    {
        if (!$this->messagesType->contains($messagesType)) {
            $this->messagesType[] = $messagesType;
            $messagesType->setTypeMessage($this);
        }

        return $this;
    }

    public function removeMessagesType(Message $messagesType): self
    {
        if ($this->messagesType->removeElement($messagesType)) {
            // set the owning side to null (unless already changed)
            if ($messagesType->getTypeMessage() === $this) {
                $messagesType->setTypeMessage(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }
}
