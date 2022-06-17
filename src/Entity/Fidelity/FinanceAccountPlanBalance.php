<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceAccountPlanBalance;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceAccountPlanBalance
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceAccountPlanBalance extends BaseFinanceAccountPlanBalance
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=22, scale=2, nullable=false)
     */
    private $amount = '0';

    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;


    //region Getters

    /**
     * @return DateTime
     * @Groups({"read-finance_account_plan_balance"})
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     * @Groups({"read-finance_account_plan_balance"})
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_account_plan_balance-relations","read-finance_account_plan_balance-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }
    //endregion

    //region Setters
    /**
     * @param DateTime $date
     * @return FinanceAccountPlanBalance
     * @Groups({"write-finance_account_plan_balance"})
     */
    public function setDate(DateTime $date): FinanceAccountPlanBalance
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string $amount
     * @return FinanceAccountPlanBalance
     * @Groups({"write-finance_account_plan_balance"})
     */
    public function setAmount(string $amount): FinanceAccountPlanBalance
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceAccountPlanBalance
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceAccountPlanBalance
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }
    //endregion
}
