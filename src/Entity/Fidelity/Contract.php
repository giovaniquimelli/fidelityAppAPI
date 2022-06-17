<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseContract;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Contract
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Contract extends BaseContract
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="contrato novo, adendos, recisoes, etc"})
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="contract_type", type="integer", nullable=false, options={"comment"="curso, material, outros"})
     */
    private $contractType;


    /**
     * @var ContractModel
     *
     * @ORM\ManyToOne(targetEntity="ContractModel")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $contractModel;

    //region Getters

    /**
     * @return string
     * @Groups({"read-contract-min","read-contract"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     * @Groups({"read-contract"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     * @Groups({"read-contract"})
     */
    public function getContractType(): int
    {
        return $this->contractType;
    }

    /**
     * @return ContractModel
     * @Groups({"read-contract-relations","read-contract-contract_model"})
     */
    public function getContractModel(): ContractModel
    {
        return $this->contractModel;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return Contract
     * @Groups({"write-contract"})
     */
    public function setName(string $name): Contract
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $type
     * @return Contract
     * @Groups({"write-contract"})
     */
    public function setType(int $type): Contract
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $contractType
     * @return Contract
     * @Groups({"write-contract"})
     */
    public function setContractType(int $contractType): Contract
    {
        $this->contractType = $contractType;
        return $this;
    }

    /**
     * @param ContractModel $contractModel
     * @return Contract
     */
    public function setContractModel(ContractModel $contractModel): Contract
    {
        $this->contractModel = $contractModel;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
