<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseContractType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ContractType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ContractType extends BaseContractType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string
     * @Groups({"read-contract_type-min","read-contract_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ContractType
     * @Groups({"write-contract_type"})
     */
    public function setName(string $name): ContractType
    {
        $this->name = $name;
        return $this;
    }
//autogenerategettersetter
}
