<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchRefCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranchRefCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchRefCategory extends BaseCompanyBranchRefCategory
{
    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CompanyBranch $companyBranch;

    /**
     * @var CompanyBranchCategory
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranchCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CompanyBranchCategory $companyBranchCategory;

    /**
     * @return CompanyBranch
     * @Groups({"read-company_branch_ref_category-relations","read-company_branch_ref_category-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return CompanyBranchRefCategory
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): CompanyBranchRefCategory
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @return CompanyBranchCategory
     * @Groups({"read-company_branch_ref_category-relations","read-company_branch_ref_category-company_branch_category"})
     */
    public function getCompanyBranchCategory(): CompanyBranchCategory
    {
        return $this->companyBranchCategory;
    }

    /**
     * @param CompanyBranchCategory $companyBranchCategory
     * @return CompanyBranchRefCategory
     */
    public function setCompanyBranchCategory(CompanyBranchCategory $companyBranchCategory): CompanyBranchRefCategory
    {
        $this->companyBranchCategory = $companyBranchCategory;
        return $this;
    }


}
