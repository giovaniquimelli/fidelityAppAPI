<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceAccountPlanRefFinanceCostCenter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceAccountPlanRefFinanceCostCenter
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceAccountPlanRefFinanceCostCenter extends BaseFinanceAccountPlanRefFinanceCostCenter
{
    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;

    /**
     * @var FinanceCostCenter
     *
     * @ORM\ManyToOne(targetEntity="FinanceCostCenter")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeCostCenter;


    //region Getters

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_account_plan_ref_finance_cost_center-relations","read-finance_account_plan_ref_finance_cost_center-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }

    /**
     * @return FinanceCostCenter
     * @Groups({"read-finance_account_plan_ref_finance_cost_center-relations","read-finance_account_plan_ref_finance_cost_center-finance_cost_center"})
     */
    public function getFinanceCostCenter(): FinanceCostCenter
    {
        return $this->financeCostCenter;
    }
    //endregion

    //region Setters
    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceAccountPlanRefFinanceCostCenter
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceAccountPlanRefFinanceCostCenter
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }

    /**
     * @param FinanceCostCenter $financeCostCenter
     * @return FinanceAccountPlanRefFinanceCostCenter
     */
    public function setFinanceCostCenter(FinanceCostCenter $financeCostCenter): FinanceAccountPlanRefFinanceCostCenter
    {
        $this->financeCostCenter = $financeCostCenter;
        return $this;
    }
    //endregion
}
