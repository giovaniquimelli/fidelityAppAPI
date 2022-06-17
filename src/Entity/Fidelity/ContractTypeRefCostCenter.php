<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseContractTypeRefCostCenter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ContractTypeRefCostCenter
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ContractTypeRefCostCenter extends BaseContractTypeRefCostCenter
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="type", type="integer", nullable=true, options={"comment"="curso, material, outrostype_contrato"})
     */
    private $type;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;

    /**
     * @var FinanceCostCenter
     *
     * @ORM\ManyToOne(targetEntity="FinanceCostCenter")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeCostCenter;

    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;


    //region Getters

    /**
     * @return int|null
     * @Groups({"read-contract_type_ref_cost_center"})
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-contract_type_ref_cost_center-relations","read-contract_type_ref_cost_center-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return FinanceCostCenter
     * @Groups({"read-contract_type_ref_cost_center-relations","read-contract_type_ref_cost_center-finance_cost_center"})
     */
    public function getFinanceCostCenter(): FinanceCostCenter
    {
        return $this->financeCostCenter;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-contract_type_ref_cost_center-relations","read-contract_type_ref_cost_center-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }
    //endregion

    //region Setters
    /**
     * @param int|null $type
     * @return ContractTypeRefCostCenter
     * @Groups({"write-contract_type_ref_cost_center"})
     */
    public function setType(?int $type): ContractTypeRefCostCenter
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return ContractTypeRefCostCenter
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): ContractTypeRefCostCenter
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param FinanceCostCenter $financeCostCenter
     * @return ContractTypeRefCostCenter
     */
    public function setFinanceCostCenter(FinanceCostCenter $financeCostCenter): ContractTypeRefCostCenter
    {
        $this->financeCostCenter = $financeCostCenter;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return ContractTypeRefCostCenter
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): ContractTypeRefCostCenter
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }
    //endregion
}
