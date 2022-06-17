<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersRefAuthPermissionCache;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersRefAuthPermissionCache
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsersRefAuthPermissionCache extends BaseUsersRefAuthPermissionCache
{
    /**
     * @var bool
     *
     * @ORM\Column(name="by_role", type="boolean", nullable=false, options={"comment"="se a permissão dada foi por role ou foi dada diretamente sem alteração nos roles do usuário"})
     */
    private $byRole = false;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $users;

    /**
     * @var AuthPermission
     *
     * @ORM\ManyToOne(targetEntity="AuthPermission")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authPermission;


    //region Getters

    /**
     * @return bool
     * @Groups({"read-users_ref_auth_permission_cache"})
     */
    public function getByRole(): bool
    {
        return $this->byRole;
    }

    /**
     * @return Users
     * @Groups({"read-users_ref_auth_permission_cache-relations","read-users_ref_auth_permission_cache-users"})
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * @return AuthPermission
     * @Groups({"read-users_ref_auth_permission_cache-relations","read-users_ref_auth_permission_cache-auth_permission"})
     */
    public function getAuthPermission(): AuthPermission
    {
        return $this->authPermission;
    }
    //endregion

    //region Setters
    /**
     * @param bool $byRole
     * @return UsersRefAuthPermissionCache
     * @Groups({"write-users_ref_auth_permission_cache"})
     */
    public function setByRole(bool $byRole): UsersRefAuthPermissionCache
    {
        $this->byRole = $byRole;
        return $this;
    }

    /**
     * @param Users $users
     * @return UsersRefAuthPermissionCache
     */
    public function setUsers(Users $users): UsersRefAuthPermissionCache
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @param AuthPermission $authPermission
     * @return UsersRefAuthPermissionCache
     */
    public function setAuthPermission(AuthPermission $authPermission): UsersRefAuthPermissionCache
    {
        $this->authPermission = $authPermission;
        return $this;
    }
    //endregion
}
