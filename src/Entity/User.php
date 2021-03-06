<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"adopting" = "Adopting", "marketer" = "Marketer"})
 * @ORM\Table(name="`user`")
 */
abstract class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(
     *     message="Le prénom ne doit pas etre vide."
     * )
     * @Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le prénom doit comporter au moins 3 caractéres",
     *     maxMessage="Le prénom ne doit pas comporter au plus 50 caractéres")
     */
    protected ?string $lastName;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(
     *     message="Le nom ne doit pas etre vide."
     * )
     * @Assert\Length(
     *     min="3",
     *     max="50",
     *     minMessage="Le nom doit comporter au moins 3 caractéres",
     *     maxMessage="Le nom ne doit pas comporter au plus 50 caractéres")
     */
    protected ?string $firstName;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message="l'email n'est pas dans bon format."
     * )
     * @Assert\NotBlank(
     *     message="Le mail ne doit pas etre vide."
     * )
     */
    protected ?string $email;

    /**
     * @var string|null The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Le mail ne doit pas etre vide. "
     * )
     * @Assert\Length(
     *     min="4",
     *     max="255",
     *     minMessage="Le mot de pass doit comporter au moins 10 caractéres",
     *     maxMessage="Le mot de pass ne doit pas comporter au plus 50 caractéres")
     */
    protected ?string $password;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    protected ?City $city;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $isAdministrator = false;

    /**
     * @ORM\Column(type="json")
     */
    protected array $roles = [];

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected ?string $phone;

    private ?string $plainPassword;

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getIsAdministrator(): ?bool
    {
        return $this->isAdministrator;
    }

    public function setIsAdministrator(bool $isAdministrator): self
    {
        $this->isAdministrator = $isAdministrator;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        if ($this->isAdministrator) {
            $roles[] = 'ROLE_ADMIN';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
