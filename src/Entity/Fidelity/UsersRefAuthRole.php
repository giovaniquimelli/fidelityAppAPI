<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersRefAuthRole;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersRefAuthRole
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsersRefAuthRole extends BaseUsersRefAuthRole
{
    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $users;

    /**
     * @var AuthRole
     *
     * @ORM\ManyToOne(targetEntity="AuthRole")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authRole;
    //region Getters

    /**
     * @return Users
     * @Groups({"read-users_ref_auth_role-relations","read-users_ref_auth_role-users"})
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * @return AuthRole
     * @Groups({"read-users_ref_auth_role-relations","read-users_ref_auth_role-auth_role"})
     */
    public function getAuthRole(): AuthRole
    {
        return $this->authRole;
    }
    //endregion

    //region Setters
    /**
     * @param Users $users
     * @return UsersRefAuthRole
     */
    public function setUsers(Users $users): UsersRefAuthRole
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @param AuthRole $authRole
     * @return UsersRefAuthRole
     */
    public function setAuthRole(AuthRole $authRole): UsersRefAuthRole
    {
        $this->authRole = $authRole;
        return $this;
    }
    //endregion
}
