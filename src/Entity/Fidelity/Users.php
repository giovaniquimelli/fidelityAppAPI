<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsers;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping\Entity;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Users
 *
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Repository\UsersRepository")
 * @\Doctrine\ORM\Mapping\HasLifecycleCallbacks()
 */
class Users extends BaseUsers implements UserInterface
{
    //const "comment"="-1 - god mod | 0 - admin | 1 - staff"}
    public const ACCESS_TYPE_GOD = -1;
    public const ACCESS_TYPE_ADMIN = 0;
    public const ACCESS_TYPE_STAFF = 1;
    public const TT = 'READ';

    /**
     * @var string
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    protected string $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected string $password = '';

    /**
     * @var array
     */
    protected array $roles = [];
    protected string $salt = '';

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private string $email;

    /**
     * @var string
     * @ORM\Column(name="mobile_phone", type="string", length=255, nullable=false, options={"comment"="definir se será obrigatório"})
     */
    private string $mobilePhone = '';

    /**
     * @var int
     *
     * @ORM\Column(name="access_type", type="integer", nullable=false, options={"comment"="-1 - god mod | 0 - admin | 1 - staff"})
     */
    private int $accessType = self::ACCESS_TYPE_ADMIN;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private bool $isActive = false;

    /**
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?CompanyBranch $companyBranch = null;

    /**
     * @ORM\OneToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true, unique=true)
     * @MaxDepth(1)
     */
    private ?Person $person = null;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private string $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reduced_name", type="string", length=255, nullable=true)
     */
    private ?string $reducedName;

    /**
     * @var MobileDeviceRefUsers[]|null
     * @ORM\OneToMany(targetEntity="MobileDeviceRefUsers", mappedBy="users")
     */
    private $mobileDeviceUsers;

//    /**
//     * @var UsersAuthToken[]|ArrayCollection|null
//     *
//     * @MaxDepth(1)
//     * @ORM\OneToMany(targetEntity="UsersAuthToken", mappedBy="users")
//     */
//    private $usersAuthToken;

    public function __construct()
    {
//        $this->usersAuthToken = new ArrayCollection();
        $this->mobileDeviceUsers = new ArrayCollection();
        $this->companyBranch = new CompanyBranch();
    }

    //#region UsersAuthToken[]
//    public function addUsersAuthToken(UsersAuthToken $usersAuthToken): self
//    {
//        if (!$this->usersAuthToken->contains($usersAuthToken)) {
//            $this->usersAuthToken[] = $usersAuthToken;
//            $usersAuthToken->setUsers($this);
//        }
//
//        return $this;
//    }

//    /**
//     * @return mixed
//     */
//    public function getUsersAuthToken()
//    {
//        return $this->usersAuthToken;
//    }
//
//    /**
//     * @param mixed $usersAuthToken
//     */
//    public function setUsersAuthToken($usersAuthToken): void
//    {
//        $this->usersAuthToken = $usersAuthToken;
//    }

//    public function removeUsersAuthToken(UsersAuthToken $usersAuthToken): self
//    {
//        if ($this->usersAuthToken->contains($usersAuthToken)) {
//            $this->usersAuthToken->removeElement($usersAuthToken);
//            // set the owning side to null (unless already changed)
//            if ($usersAuthToken->getUsers() === $this) {
//                $usersAuthToken->setUsers(null);
//            }
//        }
//
//        return $this;
//    }
    //#endregion

    //#region MobileDeviceRefUsers[]
    /**
     * @return Collection|MobileDeviceRefUsers[]
     */
    public function getMobileDeviceUsers(): Collection
    {
        return $this->mobileDeviceUsers;
    }

    public function addMobileDeviceUser(MobileDeviceRefUsers $mobileDeviceUser): self
    {
        if (!$this->mobileDeviceUsers->contains($mobileDeviceUser)) {
            $this->mobileDeviceUsers[] = $mobileDeviceUser;
            $mobileDeviceUser->setUsers($this);
        }

        return $this;
    }

    public function removeMobileDeviceUser(MobileDeviceRefUsers $mobileDeviceUser): self
    {
        if ($this->mobileDeviceUsers->contains($mobileDeviceUser)) {
            $this->mobileDeviceUsers->removeElement($mobileDeviceUser);
            // set the owning side to null (unless already changed)
            if ($mobileDeviceUser->getUsers() === $this) {
                $mobileDeviceUser->setUsers(null);
            }
        }

        return $this;
    }
    //#endregion

    //#region Getters


    /**
     * @return string|null
     * @@Groups({"read-users-min","read-users"})
     */
    public function getUser(): ?string
    {
        return $this->reducedName;
    }

    /**
     * @return string
     * @Groups({"read-users"})s
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     * @Groups({"read-users"})
     */
    public function getMobilePhone(): string
    {
        return $this->mobilePhone;
    }

    /**
     * @return int
     * @Groups({"read-users"})
     */
    public function getAccessType(): int
    {
        return $this->accessType;
    }

    /**
     * @return bool
     * @Groups({"read-users-min","read-users"})
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return CompanyBranch|null
     * @Groups({"read-users-relations","read-users-company_branch"})
     */
    public function getCompanyBranch(): ?CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return Person|null
     * @Groups({"read-users-relations","read-users-person"})
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @return string
     * @Groups({"read-users"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-users-min","read-users"})
     */
    public function getReducedName(): ?string
    {
        return $this->reducedName;
    }

    //#endregion

    //#region Setter

    /**
     * @param int $accessType
     * @return Users
     */
    public function setAccessType(int $accessType): Users
    {
        $this->accessType = $accessType;
        return $this;
    }

    /**
     * @param string $email
     * @return Users
     */
    public function setEmail(string $email): Users
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $mobilePhone
     * @return Users
     */
    public function setMobilePhone(string $mobilePhone): Users
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @param bool $isActive
     * @return Users
     */
    public function setIsActive(bool $isActive): Users
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return Users
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): Users
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param Person|null $person
     * @return Users
     */
    public function setPerson(?Person $person): Users
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param string $name
     * @return Users
     */
    public function setName(string $name): Users
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $reducedName
     * @return Users
     */
    public function setReducedName(?string $reducedName): Users
    {
        $this->reducedName = $reducedName;
        return $this;
    }

    //#endregion
//autogenerategettersetter
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
        // return $this->roles;
        return ['ROLE_USER'];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
        return $this->password;
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
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->username;
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
