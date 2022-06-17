<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAccount;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Account
 *
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Account extends BaseAccount implements UserInterface
{
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private Person $person;

    /**
     * @var Account|null
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?Account $account; // nullable

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private bool $active;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private string $username; // both person types

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private string $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private string $email; // nullable

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_date", type="string", length=255, nullable=true)
     */
    private ?string $birthDate = null; // nullable

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_phone", type="string", length=255, nullable=false)
     */
    private string $mobilePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
     */
    private string $fullName; // both person types

    /**
     * @var string|null
     *
     * @ORM\Column(name="legal_name", type="string", length=255, nullable=true)
     */
    private ?string $legalName = null;

    public function __construct()
    {
        $this->person = new Person();
        // $this->account = new Account();

    }

    /**
     * @return Person
     * @Groups({"read-account-relations","read-account-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @Groups({"read-account-relations","read-account-person"})
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }

    /**
     * @return Account|null
     * @Groups({"read-account-relations","read-account-account"})
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(?Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return bool
     * @Groups({"read-account"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     * @Groups({"read-account-min","read-account"})
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     * @Groups({"read-account-min","read-account"})
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     * @Groups({"read-account"})
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @param string|null $birthDate
     */
    public function setBirthDate(?string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     * @Groups({"read-account-min","read-account"})
     */
    public function getMobilePhone(): string
    {
        return $this->mobilePhone;
    }

    /**
     * @param string $mobilePhone
     */
    public function setMobilePhone(string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * @return string
     * @Groups({"read-account-min","read-account"})
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string|null
     * @Groups({"read-account-min","read-account"})
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @param string|null $legalName
     */
    public function setLegalName(?string $legalName): void
    {
        $this->legalName = $legalName;
    } // nullable


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
