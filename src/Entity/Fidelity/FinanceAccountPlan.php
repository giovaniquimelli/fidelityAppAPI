<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceAccountPlan;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceAccountPlan
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceAccountPlan extends BaseFinanceAccountPlan
{
    /**
     * @var string
     *
     * @ORM\Column(name="account_code", type="string", length=255, nullable=false)
     */
    private $accountCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="analytic", type="boolean", nullable=false)
     */
    private $analytic = false;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="ativo, passivo, receita, despesa"})
     */
    private $type;


    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;

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
     * @Groups({"read-finance_account_plan"})
     */
    public function getAccountCode(): string
    {
        return $this->accountCode;
    }

    /**
     * @return string
     * @Groups({"read-finance_account_plan"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-finance_account_plan"})
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     * @Groups({"read-finance_account_plan"})
     */
    public function getAnalytic(): bool
    {
        return $this->analytic;
    }

    /**
     * @return int
     * @Groups({"read-finance_account_plan"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_account_plan-relations","read-finance_account_plan-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-finance_account_plan-relations","read-finance_account_plan-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters
    /**
     * @param string $accountCode
     * @return FinanceAccountPlan
     * @Groups({"write-finance_account_plan"})
     */
    public function setAccountCode(string $accountCode): FinanceAccountPlan
    {
        $this->accountCode = $accountCode;
        return $this;
    }

    /**
     * @param string $name
     * @return FinanceAccountPlan
     * @Groups({"write-finance_account_plan"})
     */
    public function setName(string $name): FinanceAccountPlan
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return FinanceAccountPlan
     * @Groups({"write-finance_account_plan"})
     */
    public function setDescription(string $description): FinanceAccountPlan
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param bool $analytic
     * @return FinanceAccountPlan
     * @Groups({"write-finance_account_plan"})
     */
    public function setAnalytic(bool $analytic): FinanceAccountPlan
    {
        $this->analytic = $analytic;
        return $this;
    }

    /**
     * @param int $type
     * @return FinanceAccountPlan
     * @Groups({"write-finance_account_plan"})
     */
    public function setType(int $type): FinanceAccountPlan
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceAccountPlan
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceAccountPlan
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return FinanceAccountPlan
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): FinanceAccountPlan
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion
}
