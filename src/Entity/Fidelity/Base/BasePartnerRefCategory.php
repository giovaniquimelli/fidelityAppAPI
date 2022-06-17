<?php

namespace App\Entity\Fidelity\Base;

use App\Entity\Fidelity\Users;
use \DateTime;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class BasePartnerRefCategory extends \App\Doctrine\BaseDefaultEntity
{
    //#region DefaultEntity

    /**
     * @return UuidInterface;
     * @Groups({"read-partner_ref_category-id"})
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return self
     */
    public function setId(UuidInterface $id): self
    {
        $this->id = $id;
        return $this;
    }
    //#endregion
}
