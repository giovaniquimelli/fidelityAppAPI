<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinancePaymentType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinancePaymentType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinancePaymentType extends BaseFinancePaymentType
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
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="typeRecebimentoEnum"})
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="payment_type", type="integer", nullable=false, options={"comment"="A VISTA, A PRAZO"})
     */
    private $paymentType;


    //region Getters

    /**
     * @return string
     * @Groups({"read-finance_payment_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     * @Groups({"read-finance_payment_type"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     * @Groups({"read-finance_payment_type"})
     */
    public function getPaymentType(): int
    {
        return $this->paymentType;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return FinancePaymentType
     * @Groups({"write-finance_payment_type"})
     */
    public function setName(string $name): FinancePaymentType
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $type
     * @return FinancePaymentType
     * @Groups({"write-finance_payment_type"})
     */
    public function setType(int $type): FinancePaymentType
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $paymentType
     * @return FinancePaymentType
     * @Groups({"write-finance_payment_type"})
     */
    public function setPaymentType(int $paymentType): FinancePaymentType
    {
        $this->paymentType = $paymentType;
        return $this;
    }
    //endregion
}
