<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentType extends BaseEquipmentType
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
     * @Groups({"read-equipment_type"})
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $name
     * @return EquipmentType
     * @Groups({"write-equipment_type"})
     */
    public function setName(?string $name): EquipmentType
    {
        $this->name = $name;
        return $this;
    }
    //endregion
}
