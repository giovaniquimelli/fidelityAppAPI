<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAuthPermission;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AuthPermission
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AuthPermission extends BaseAuthPermission
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
     * @ORM\Column(name="permission_name", type="string", length=255, nullable=false)
     */
    private $permissionName;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=255, nullable=false)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="config", type="string", length=255, nullable=false)
     */
    private $config;

    /**
     * @var int
     *
     * @ORM\Column(name="system_id", type="integer", nullable=false)
     */
    private $systemId;

    /**
     * @var AuthPermissionCategory
     *
     * @ORM\ManyToOne(targetEntity="AuthPermissionCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authPermissionCategory;

    /**
     * @return string
     * @Groups({"read-auth_permission-min","read-auth_permission"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getConfig(): string
    {
        return $this->config;
    }

    /**
     * @return int
     */
    public function getSystemId(): int
    {
        return $this->systemId;
    }

    /**
     * @return AuthPermissionCategory
     */
    public function getAuthPermissionCategory(): AuthPermissionCategory
    {
        return $this->authPermissionCategory;
    }

    /**
     * @param string $name
     * @return AuthPermission
     */
    public function setName(string $name): AuthPermission
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $description
     * @return AuthPermission
     */
    public function setDescription(?string $description): AuthPermission
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $permissionName
     * @return AuthPermission
     */
    public function setPermissionName(string $permissionName): AuthPermission
    {
        $this->permissionName = $permissionName;
        return $this;
    }

    /**
     * @param string $controller
     * @return AuthPermission
     */
    public function setController(string $controller): AuthPermission
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return AuthPermission
     */
    public function setAction(string $action): AuthPermission
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $config
     * @return AuthPermission
     */
    public function setConfig(string $config): AuthPermission
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param int $systemId
     * @return AuthPermission
     */
    public function setSystemId(int $systemId): AuthPermission
    {
        $this->systemId = $systemId;
        return $this;
    }

    /**
     * @param AuthPermissionCategory $authPermissionCategory
     * @return AuthPermission
     */
    public function setAuthPermissionCategory(AuthPermissionCategory $authPermissionCategory): AuthPermission
    {
        $this->authPermissionCategory = $authPermissionCategory;
        return $this;
    }
    //autogenerategettersetter
}
