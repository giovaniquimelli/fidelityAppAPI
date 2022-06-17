<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseUsersRefCompanyBranch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersRefCompanyBranch
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsersRefCompanyBranch extends BaseUsersRefCompanyBranch
{
    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $users;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;


    //region Getters

    /**
     * @return Users
     * @Groups({"read-users_ref_company_branch-relations","read-users_ref_company_branch-users"})
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-users_ref_company_branch-relations","read-users_ref_company_branch-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters
    /**
     * @param Users $users
     * @return UsersRefCompanyBranch
     */
    public function setUsers(Users $users): UsersRefCompanyBranch
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return UsersRefCompanyBranch
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): UsersRefCompanyBranch
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion
}
