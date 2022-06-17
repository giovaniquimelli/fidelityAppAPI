<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceAccountPlanEntry;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceAccountPlanEntry
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceAccountPlanEntry extends BaseFinanceAccountPlanEntry
{
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
     * @return string
     * @Groups({"read-finance_account_plan_entry"})
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_account_plan_entry-relations","read-finance_account_plan_entry-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }
    //endregion

    //region Setters
    /**
     * @param string $amount
     * @return FinanceAccountPlanEntry
     * @Groups({"write-finance_account_plan_entry"})
     */
    public function setAmount(string $amount): FinanceAccountPlanEntry
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceAccountPlanEntry
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceAccountPlanEntry
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }
    //endregion
}
