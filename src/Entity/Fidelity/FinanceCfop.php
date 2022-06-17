<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceCfop;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceCfop
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceCfop extends BaseFinanceCfop
{
    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=false)
     */
    private $remarks;

    /**
     * @var int
     *
     * @ORM\Column(name="cfop_code", type="integer", nullable=false)
     */
    private $cfopCode;


    //region Getters

    /**
     * @return string
     * @Groups({"read-finance_cfop"})
     */
    public function getRemarks(): string
    {
        return $this->remarks;
    }

    /**
     * @return int
     * @Groups({"read-finance_cfop"})
     */
    public function getCfopCode(): int
    {
        return $this->cfopCode;
    }
    //endregion

    //region Setters
    /**
     * @param string $remarks
     * @return FinanceCfop
     * @Groups({"write-finance_cfop"})
     */
    public function setRemarks(string $remarks): FinanceCfop
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param int $cfopCode
     * @return FinanceCfop
     * @Groups({"write-finance_cfop"})
     */
    public function setCfopCode(int $cfopCode): FinanceCfop
    {
        $this->cfopCode = $cfopCode;
        return $this;
    }
    //endregion
}
