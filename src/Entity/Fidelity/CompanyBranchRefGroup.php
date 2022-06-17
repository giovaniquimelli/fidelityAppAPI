<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchRefGroup;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranchRefGroup
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchRefGroup extends BaseCompanyBranchRefGroup
{
    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CompanyBranch $companyBranch;

    /**
     * @var CompanyBranchGroup
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranchGroup")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CompanyBranchGroup $companyBranchGroup;

    /**
     * @return CompanyBranch
     * @Groups({"read-company_branch_ref_group-relations","read-company_branch_ref_group-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return CompanyBranchRefGroup
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): CompanyBranchRefGroup
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @return CompanyBranchGroup
     * @Groups({"read-company_branch_ref_group-relations","read-company_branch_ref_group-company_branch_group"})
     */
    public function getCompanyBranchGroup(): CompanyBranchGroup
    {
        return $this->companyBranchGroup;
    }

    /**
     * @param CompanyBranchGroup $companyBranchGroup
     * @return CompanyBranchRefGroup
     */
    public function setCompanyBranchGroup(CompanyBranchGroup $companyBranchGroup): CompanyBranchRefGroup
    {
        $this->companyBranchGroup = $companyBranchGroup;
        return $this;
    }



}
