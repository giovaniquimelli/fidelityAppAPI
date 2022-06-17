<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePartnerCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * PartnerCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PartnerCategory extends BasePartnerCategory
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
     * @return PartnerCategory
     * @Groups({"write-partner_category"})
     */
    public function setName(string $name): PartnerCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-partner_category-min","read-partner_category"})
     */
    public function getReducedName(): string
    {
        return $this->reducedName;
    }

    /**
     * @param string $reducedName
     * @return PartnerCategory
     * @Groups({"write-partner_category"})
     */
    public function setReducedName(string $reducedName): PartnerCategory
    {
        $this->reducedName = $reducedName;
        return $this;
    }

    /**
     * @return bool
     * @Groups({"read-partner_category-min","read-partner_category"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return PartnerCategory
     * @Groups({"write-partner_category"})
     */
    public function setActive(bool $active): PartnerCategory
    {
        $this->active = $active;
        return $this;
    }


}
