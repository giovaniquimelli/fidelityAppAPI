<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchGroup;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranchGroup
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchGroup extends BaseCompanyBranchGroup
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
    private bool $active = true;

    /**
     * @return string
     * @Groups({"read-company_branch_group-min","read-company_branch_group"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CompanyBranchGroup
     */
    public function setName(string $name): CompanyBranchGroup
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch_group-min","read-company_branch_group"})
     */
    public function getReducedName(): string
    {
        return $this->reducedName;
    }

    /**
     * @param string $reducedName
     * @return CompanyBranchGroup
     */
    public function setReducedName(string $reducedName): CompanyBranchGroup
    {
        $this->reducedName = $reducedName;
        return $this;
    }

    /**
     * @return bool
     * @Groups({"read-company_branch_group-min","read-company_branch_group"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return CompanyBranchGroup
     */
    public function setActive(bool $active): CompanyBranchGroup
    {
        $this->active = $active;
        return $this;
    }


}
