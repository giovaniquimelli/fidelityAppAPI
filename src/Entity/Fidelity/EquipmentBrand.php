<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentBrand;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentBrand
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentBrand extends BaseEquipmentBrand
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-equipment_brand"})
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $name
     * @return EquipmentBrand
     * @Groups({"write-equipment_brand"})
     */
    public function setName(?string $name): EquipmentBrand
    {
        $this->name = $name;
        return $this;
    }
    //endregion
}
