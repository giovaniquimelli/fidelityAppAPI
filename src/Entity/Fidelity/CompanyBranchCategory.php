<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranchCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchCategory extends BaseCompanyBranchCategory
{
    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="reduced_name", type="string", length=255, nullable=false)
     */
    private string $reducedName;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private bool $active;

    /**
     * @return string
     * @Groups({"read-company_branch_category-min","read-company_branch_category"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CompanyBranchCategory
     */
    public function setName(string $name): CompanyBranchCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch_category-min","read-company_branch_category"})
     */
    public function getReducedName(): string
    {
        return $this->reducedName;
    }

    /**
     * @param string $reducedName
     * @return CompanyBranchCategory
     */
    public function setReducedName(string $reducedName): CompanyBranchCategory
    {
        $this->reducedName = $reducedName;
        return $this;
    }

    /**
     * @return bool
     * @Groups({"read-company_branch_category-min","read-company_branch_category"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return CompanyBranchCategory
     */
    public function setActive(bool $active): CompanyBranchCategory
    {
        $this->active = $active;
        return $this;
    }


}
