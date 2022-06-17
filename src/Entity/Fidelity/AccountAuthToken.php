<?php

namespace App\Entity\Fidelity;

use App\Doctrine\Traits\GuidEntity;
use App\Doctrine\Traits\TimestampableEntity;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\Base\BaseAccountAuthToken;
use App\Entity\Fidelity\Users;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AccountAuthToken
 *
 * @ORM\Entity(repositoryClass="App\Repository\AccountAuthTokenRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class AccountAuthToken extends BaseAccountAuthToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="main_role", type="string", length=255, nullable=false)
     */
    private string $mainRole;
    /**
     * @var DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=false)
     */
    private DateTime $expiresAt;
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     * @Serializer\Groups({"default"})
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
     * @Assert\Type("string")
     */
    private $isValid = true;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fidelity\Account", inversedBy="accountAuthToken")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @Serializer\MaxDepth(1)
     */
    private Account $account;


    /**
     * @return string
     */
    public function getMainRole(): string
    {
        return $this->mainRole;
    }

    /**
     * @param string $mainRole
     */
    public function setMainRole(string $mainRole): void
    {
        $this->mainRole = $mainRole;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime $expiresAt
     */
    public function setExpiresAt(DateTime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getRolesJson(): string
    {
        return $this->rolesJson;
    }

    /**
     * @param string $rolesJson
     */
    public function setRolesJson(string $rolesJson): void
    {
        $this->rolesJson = $rolesJson;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload(string $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account): void
    {
        $this->account = $account;
    }

    public function setSysAdmin()
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(Users::ref(container_param_get('sys_web_id')));
            }
        } else {
            $this->setUpdatedBy(Users::ref(container_param_get('sys_web_id')));
        }
    }
//autogenerategettersetter
}
