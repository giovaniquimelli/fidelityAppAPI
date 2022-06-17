<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersRememberToken;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersRememberToken
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsersRememberToken extends BaseUsersRememberToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="expiration_datetime", type="datetime", nullable=false)
     */
    private $expirationDatetime;


    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $wasUsed = false;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $users;


    //region Getters

    /**
     * @return string
     * @Groups({"read-users_remember_token"})
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return DateTime
     * @Groups({"read-users_remember_token"})
     */
    public function getExpirationDatetime(): DateTime
    {
        return $this->expirationDatetime;
    }

    /**
     * @return bool
     * @Groups({"read-users_remember_token"})
     */
    public function getWasUsed(): bool
    {
        return $this->wasUsed;
    }

    /**
     * @return Users
     * @Groups({"read-users_remember_token-relations","read-users_remember_token-users"})
     */
    public function getUsers(): Users
    {
        return $this->users;
    }
    //endregion

    //region Setters
    /**
     * @param string $token
     * @return UsersRememberToken
     * @Groups({"write-users_remember_token"})
     */
    public function setToken(string $token): UsersRememberToken
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param DateTime $expirationDatetime
     * @return UsersRememberToken
     * @Groups({"write-users_remember_token"})
     */
    public function setExpirationDatetime(DateTime $expirationDatetime): UsersRememberToken
    {
        $this->expirationDatetime = $expirationDatetime;
        return $this;
    }

    /**
     * @param bool $wasUsed
     * @return UsersRememberToken
     * @Groups({"write-users_remember_token"})
     */
    public function setWasUsed(bool $wasUsed): UsersRememberToken
    {
        $this->wasUsed = $wasUsed;
        return $this;
    }

    /**
     * @param Users $users
     * @return UsersRememberToken
     */
    public function setUsers(Users $users): UsersRememberToken
    {
        $this->users = $users;
        return $this;
    }
    //endregion
}
