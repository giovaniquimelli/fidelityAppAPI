<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersAuthToken;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * UsersAuthToken
 *
 * @ORM\Entity(repositoryClass="App\Repository\UsersAuthTokenRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UsersAuthToken extends BaseUsersAuthToken
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="main_role", type="string", length=255, nullable=false)
     */
    private $mainRole;
    /**
     * @var DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=false)
     */
    private $expiresAt;
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;
    /**
     * @var string
     *
     * @ORM\Column(name="roles_json", type="text", nullable=false)
     */
    private $rolesJson;
    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text", nullable=false)
     */
    private $payload;
    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=255, nullable=false)
     */
    private $ipAddress;
    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=false)
     */
    private $userAgent;
    /**
     * @var bool
     *
     * @ORM\Column(name="is_valid", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isValid = true;
    /**
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @Serializer\MaxDepth(1)
     */
    private $users;
    //endregion

    //region Getters
    /**
     * @return string
     */
    public function getMainRole(): string
    {
        return $this->mainRole;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getRolesJson(): string
    {
        return $this->rolesJson;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }
    //endregion

    //region Setters
    /**
     * @param string $mainRole
     * @return UsersAuthToken
     */
    public function setMainRole(string $mainRole): UsersAuthToken
    {
        $this->mainRole = $mainRole;
        return $this;
    }

    /**
     * @param DateTime $expiresAt
     * @return UsersAuthToken
     */
    public function setExpiresAt(DateTime $expiresAt): UsersAuthToken
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * @param string $token
     * @return UsersAuthToken
     */
    public function setToken(string $token): UsersAuthToken
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param string $rolesJson
     * @return UsersAuthToken
     */
    public function setRolesJson(string $rolesJson): UsersAuthToken
    {
        $this->rolesJson = $rolesJson;
        return $this;
    }

    /**
     * @param string $payload
     * @return UsersAuthToken
     */
    public function setPayload(string $payload): UsersAuthToken
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @param string $ipAddress
     * @return UsersAuthToken
     */
    public function setIpAddress(string $ipAddress): UsersAuthToken
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @param string $userAgent
     * @return UsersAuthToken
     */
    public function setUserAgent(string $userAgent): UsersAuthToken
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @param bool $isValid
     * @return UsersAuthToken
     */
    public function setIsValid(bool $isValid): UsersAuthToken
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * @param mixed $users
     * @return UsersAuthToken
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }
    //endregion
}
