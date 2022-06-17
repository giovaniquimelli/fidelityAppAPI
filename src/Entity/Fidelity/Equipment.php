<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipment;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Equipment
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Equipment extends BaseEquipment
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;

    /**
     * @var EquipmentModel
     *
     * @ORM\ManyToOne(targetEntity="EquipmentModel")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $equipmentModel;

    /**
     * @var EquipmentType
     *
     * @ORM\ManyToOne(targetEntity="EquipmentType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $equipmentType;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-equipment"})
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-equipment-relations","read-equipment-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return EquipmentModel
     * @Groups({"read-equipment-relations","read-equipment-equipment_model"})
     */
    public function getEquipmentModel(): EquipmentModel
    {
        return $this->equipmentModel;
    }

    /**
     * @return EquipmentType
     * @Groups({"read-equipment-relations","read-equipment-equipment_type"})
     */
    public function getEquipmentType(): EquipmentType
    {
        return $this->equipmentType;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $name
     * @return Equipment
     * @Groups({"write-equipment"})
     */
    public function setName(?string $name): Equipment
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return Equipment
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): Equipment
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param EquipmentModel $equipmentModel
     * @return Equipment
     */
    public function setEquipmentModel(EquipmentModel $equipmentModel): Equipment
    {
        $this->equipmentModel = $equipmentModel;
        return $this;
    }

    /**
     * @param EquipmentType $equipmentType
     * @return Equipment
     */
    public function setEquipmentType(EquipmentType $equipmentType): Equipment
    {
        $this->equipmentType = $equipmentType;
        return $this;
    }
    //endregion
}
