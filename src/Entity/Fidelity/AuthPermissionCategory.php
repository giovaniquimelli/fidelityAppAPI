<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BaseAuthPermissionCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AuthPermissionCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AuthPermissionCategory extends BaseAuthPermissionCategory
{/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

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


    //region Getters
    /**
     * @return string
     * @Groups({"read-auth_permission_category"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     * @Groups({"read-auth_permission_category"})
     */
    public function getSystemId(): int
    {
        return $this->systemId;
    }

    /**
     * @return AuthPermissionCategory
     * @Groups({"read-auth_permission_category-relations","read-auth_permission_category-auth_permission_category"})
     */
    public function getAuthPermissionCategory(): AuthPermissionCategory
    {
        return $this->authPermissionCategory;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return AuthPermissionCategory
     * @Groups({"write-auth_permission_category"})
     */
    public function setName(string $name): AuthPermissionCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $systemId
     * @return AuthPermissionCategory
     * @Groups({"write-auth_permission_category"})
     */
    public function setSystemId(int $systemId): AuthPermissionCategory
    {
        $this->systemId = $systemId;
        return $this;
    }

    /**
     * @param AuthPermissionCategory $authPermissionCategory
     * @return AuthPermissionCategory
     */
    public function setAuthPermissionCategory(AuthPermissionCategory $authPermissionCategory): AuthPermissionCategory
    {
        $this->authPermissionCategory = $authPermissionCategory;
        return $this;
    }
    //endregion
}
