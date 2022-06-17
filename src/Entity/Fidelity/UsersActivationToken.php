<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersActivationToken;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersActivationToken
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsersActivationToken extends BaseUsersActivationToken
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
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $users;


    //region Getters

    /**
     * @return string
     * @Groups({"read-users_activation_token"})
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return DateTime
     * @Groups({"read-users_activation_token"})
     */
    public function getExpirationDatetime(): DateTime
    {
        return $this->expirationDatetime;
    }

    /**
     * @return Users
     * @Groups({"read-users_activation_token-relations","read-users_activation_token-users"})
     */
    public function getUsers(): Users
    {
        return $this->users;
    }
    //endregion

    //region Setters
    /**
     * @param string $token
     * @return UsersActivationToken
     * @Groups({"write-users_activation_token"})
     */
    public function setToken(string $token): UsersActivationToken
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param DateTime $expirationDatetime
     * @return UsersActivationToken
     * @Groups({"write-users_activation_token"})
     */
    public function setExpirationDatetime(DateTime $expirationDatetime): UsersActivationToken
    {
        $this->expirationDatetime = $expirationDatetime;
        return $this;
    }

    /**
     * @param Users $users
     * @return UsersActivationToken
     */
    public function setUsers(Users $users): UsersActivationToken
    {
        $this->users = $users;
        return $this;
    }
    //endregion
}
