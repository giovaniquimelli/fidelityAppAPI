<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePartnerRefCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * PartnersRefCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PartnerRefCategory extends BasePartnerRefCategory
{
    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Partner")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private Partner $partner;

    /**
     * @var PartnerCategory
     *
     * @ORM\ManyToOne(targetEntity="PartnerCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private PartnerCategory $partnerCategory;

    /**
     * @return Partner
     * @Groups({"read-partner_ref_category-relations","read-partner_ref_category-partner"})
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }

    /**
     * @return PartnerCategory
     * @Groups({"read-partner_ref_category-relations","read-partner_ref_category-partner_category"})
     */
    public function getPartnerCategory(): PartnerCategory
    {
        return $this->partnerCategory;
    }




}
