<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAuthRoleRefAuthPermission;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AuthRoleRefAuthPermission
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AuthRoleRefAuthPermission extends BaseAuthRoleRefAuthPermission
{
    /**
     * @var AuthRole
     *
     * @ORM\ManyToOne(targetEntity="AuthRole")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authRole;

    /**
     * @var AuthPermission
     *
     * @ORM\ManyToOne(targetEntity="AuthPermission")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authPermission;


    //region Getters

    /**
     * @return AuthRole
     * @Groups({"read-auth_role_ref_auth_permission-relations","read-auth_role_ref_auth_permission-auth_role"})
     */
    public function getAuthRole(): AuthRole
    {
        return $this->authRole;
    }

    /**
     * @return AuthPermission
     * @Groups({"read-auth_role_ref_auth_permission-relations","read-auth_role_ref_auth_permission-auth_permission"})
     */
    public function getAuthPermission(): AuthPermission
    {
        return $this->authPermission;
    }
    //endregion

    //region Setters
    /**
     * @param AuthRole $authRole
     * @return AuthRoleRefAuthPermission
     */
    public function setAuthRole(AuthRole $authRole): AuthRoleRefAuthPermission
    {
        $this->authRole = $authRole;
        return $this;
    }

    /**
     * @param AuthPermission $authPermission
     * @return AuthRoleRefAuthPermission
     */
    public function setAuthPermission(AuthPermission $authPermission): AuthRoleRefAuthPermission
    {
        $this->authPermission = $authPermission;
        return $this;
    }
    //endregion
}
