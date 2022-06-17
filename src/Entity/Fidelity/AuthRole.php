<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAuthRole;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AuthRole
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AuthRole extends BaseAuthRole
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=255, nullable=false)
     */
    private $roleName;



    /**
     * @var bool
     *
     * @ORM\Column(name="sysadmin", type="boolean", nullable=false)
     */
    private $sysadmin = false;

    /**
     * @var int
     *
     * @ORM\Column(name="system_id", type="integer", nullable=false)
     */
    private $systemId;

    /**
     * @var AuthRole
     *
     * @ORM\ManyToOne(targetEntity="AuthRole")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authRole;

    //region Getters
    /**
     * @return string
     * @Groups({"read-auth_role-min","read-auth_role"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-auth_role"})
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     * @Groups({"read-auth_role"})
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @return bool
     * @Groups({"read-auth_role"})
     */
    public function getSysadmin(): bool
    {
        return $this->sysadmin;
    }

    /**
     * @return int
     * @Groups({"read-auth_role"})
     */
    public function getSystemId(): int
    {
        return $this->systemId;
    }

    /**
     * @return AuthRole
     * @Groups({"read-auth_role-relations","read-auth_role-auth_role"})
     */
    public function getAuthRole(): AuthRole
    {
        return $this->authRole;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return AuthRole
     * @Groups({"write-auth_role"})
     */
    public function setName(string $name): AuthRole
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $description
     * @return AuthRole
     * @Groups({"write-auth_role"})
     */
    public function setDescription(?string $description): AuthRole
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $roleName
     * @return AuthRole
     * @Groups({"write-auth_role"})
     */
    public function setRoleName(string $roleName): AuthRole
    {
        $this->roleName = $roleName;
        return $this;
    }

    /**
     * @param bool $sysadmin
     * @return AuthRole
     * @Groups({"write-auth_role"})
     */
    public function setSysadmin(bool $sysadmin): AuthRole
    {
        $this->sysadmin = $sysadmin;
        return $this;
    }

    /**
     * @param int $systemId
     * @return AuthRole
     * @Groups({"write-auth_role"})
     */
    public function setSystemId(int $systemId): AuthRole
    {
        $this->systemId = $systemId;
        return $this;
    }

    /**
     * @param AuthRole $authRole
     * @return AuthRole
     */
    public function setAuthRole(AuthRole $authRole): AuthRole
    {
        $this->authRole = $authRole;
        return $this;
    }
    //endregion
}
