<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceCostCenter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceCostCenter
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceCostCenter extends BaseFinanceCostCenter
{
    /**
     * @var string
     *
     * @ORM\Column(name="finance_account", type="string", length=255, nullable=false)
     */
    private $financeAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=false)
     */
    private $remarks;

    /**
     * @var bool
     *
     * @ORM\Column(name="analytic", type="boolean", nullable=false)
     */
    private $analytic = false;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="despesa, receita?"})
     */
    private $type;


    /**
     * @var FinanceCostCenter
     *
     * @ORM\ManyToOne(targetEntity="FinanceCostCenter")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeCostCenter;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;


    //region Getters

    /**
     * @return string
     * @Groups({"read-finance_cost_center"})
     */
    public function getFinanceAccount(): string
    {
        return $this->financeAccount;
    }

    /**
     * @return string
     * @Groups({"read-finance_cost_center"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-finance_cost_center"})
     */
    public function getRemarks(): string
    {
        return $this->remarks;
    }

    /**
     * @return bool
     * @Groups({"read-finance_cost_center"})
     */
    public function getAnalytic(): bool
    {
        return $this->analytic;
    }

    /**
     * @return int
     * @Groups({"read-finance_cost_center"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return FinanceCostCenter
     * @Groups({"read-finance_cost_center-relations","read-finance_cost_center-finance_cost_center"})
     */
    public function getFinanceCostCenter(): FinanceCostCenter
    {
        return $this->financeCostCenter;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-finance_cost_center-relations","read-finance_cost_center-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters
    /**
     * @param string $financeAccount
     * @return FinanceCostCenter
     * @Groups({"write-finance_cost_center"})
     */
    public function setFinanceAccount(string $financeAccount): FinanceCostCenter
    {
        $this->financeAccount = $financeAccount;
        return $this;
    }

    /**
     * @param string $name
     * @return FinanceCostCenter
     * @Groups({"write-finance_cost_center"})
     */
    public function setName(string $name): FinanceCostCenter
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $remarks
     * @return FinanceCostCenter
     * @Groups({"write-finance_cost_center"})
     */
    public function setRemarks(string $remarks): FinanceCostCenter
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param bool $analytic
     * @return FinanceCostCenter
     * @Groups({"write-finance_cost_center"})
     */
    public function setAnalytic(bool $analytic): FinanceCostCenter
    {
        $this->analytic = $analytic;
        return $this;
    }

    /**
     * @param int $type
     * @return FinanceCostCenter
     * @Groups({"write-finance_cost_center"})
     */
    public function setType(int $type): FinanceCostCenter
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param FinanceCostCenter $financeCostCenter
     * @return FinanceCostCenter
     */
    public function setFinanceCostCenter(FinanceCostCenter $financeCostCenter): FinanceCostCenter
    {
        $this->financeCostCenter = $financeCostCenter;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return FinanceCostCenter
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): FinanceCostCenter
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion
}
