<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceCardPayment;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceCardPayment
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceCardPayment extends BaseFinanceCardPayment
{
    /**
     * @var FinanceBilling
     *
     * @ORM\ManyToOne(targetEntity="FinanceBilling")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeBilling;


    //region Getters

    /**
     * @return FinanceBilling
     * @Groups({"read-finance_card_payment-relations","read-finance_card_payment-finance_billing"})
     */
    public function getFinanceBilling(): FinanceBilling
    {
        return $this->financeBilling;
    }
    //endregion

    //region Setters
    /**
     * @param FinanceBilling $financeBilling
     * @return FinanceCardPayment
     */
    public function setFinanceBilling(FinanceBilling $financeBilling): FinanceCardPayment
    {
        $this->financeBilling = $financeBilling;
        return $this;
    }
    //endregion
}
