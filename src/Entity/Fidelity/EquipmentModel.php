<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentModel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentModel
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentModel extends BaseEquipmentModel
{
    /**
     * @var EquipmentBrand
     *
     * @ORM\ManyToOne(targetEntity="EquipmentBrand")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $equipmentBrand;


    //region Getters

    /**
     * @return EquipmentBrand
     * @Groups({"read-equipment_model-relations","read-equipment_model-equipment_brand"})
     */
    public function getEquipmentBrand(): EquipmentBrand
    {
        return $this->equipmentBrand;
    }
    //endregion

    //region Setters
    /**
     * @param EquipmentBrand $equipmentBrand
     * @return EquipmentModel
     */
    public function setEquipmentBrand(EquipmentBrand $equipmentBrand): EquipmentModel
    {
        $this->equipmentBrand = $equipmentBrand;
        return $this;
    }
    //endregion
}
