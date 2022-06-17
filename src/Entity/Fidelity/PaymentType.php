<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePaymentType;
use App\Util\InternalPaymentType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * PaymentType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PaymentType extends BasePaymentType
{
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name = '';
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "InternalPaymentType::FIDELITY"})
     */
    private int $internalPaymentType = InternalPaymentType::FIDELITY;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":"true"})
     */
    private bool $active = true;
    /**
     * @ORM\Column(name="order_seq", type="integer", nullable=false, options={"default":"-1"})
     */
    private int $order = -1;
    /**
     * @ORM\Column(type="text")
     */
    private string $altNames = '';
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "false"})
     * @Groups({"read-payment_type"})
     */
    private bool $defaultIfNotFound = false;

    /**
     * @var ArrayCollection<PaymentTypeCompanyBranch>|PaymentTypeCompanyBranch[]|null
     *
     * @ORM\OneToMany(targetEntity="PaymentTypeCompanyBranch", mappedBy="paymentType", cascade={"persist"})
     */
    private $paymentTypeCompanyBranch;

    public function __construct()
    {
        $this->paymentTypeCompanyBranch = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|PaymentTypeCompanyBranch[]||null
     * @Groups({"read-payment_type-relations","read-payment_type-payment_type_company_branch"})
     */
    public function getPaymentTypeCompanyBranch()
    {
        return $this->paymentTypeCompanyBranch;
    }

    /**
     * @param string $name
     * @return PaymentType
     * @Groups({"write-payment_type"})
     */
    public function setName(string $name): PaymentType
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $internalPaymentType
     * @return PaymentType
     */
    public function setInternalPaymentType(int $internalPaymentType): PaymentType
    {
        $this->internalPaymentType = $internalPaymentType;
        return $this;
    }

    /**
     * @param bool $active
     * @return PaymentType
     * @Groups({"write-payment_type"})
     */
    public function setActive(bool $active): PaymentType
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param int $order
     * @return PaymentType
     * @Groups({"write-payment_type"})
     */
    public function setOrder(int $order): PaymentType
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param string $altNames
     * @return PaymentType
     * @Groups({"write-payment_type"})
     */
    public function setAltNames(string $altNames): PaymentType
    {
        $this->altNames = $altNames;
        return $this;
    }

    /**
     * @param bool $defaultIfNotFound
     * @return PaymentType
     * @Groups({"write-payment_type"})
     */
    public function setDefaultIfNotFound(bool $defaultIfNotFound): PaymentType
    {
        $this->defaultIfNotFound = $defaultIfNotFound;
        return $this;
    }

    /**
     * @param PaymentTypeCompanyBranch[]|ArrayCollection|null $paymentTypeCompanyBranch
     * @return self
     */
    public function setPaymentTypeCompanyBranch($paymentTypeCompanyBranch): self
    {
        $this->paymentTypeCompanyBranch = $paymentTypeCompanyBranch;
        return $this;
    }


    /**
     * @return string
     * @Groups({"read-payment_type-min","read-payment_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     * @Groups({"read-payment_type"})
     */
    public function getInternalPaymentType(): int
    {
        return $this->internalPaymentType;
    }

    /**
     * @return bool
     * @Groups({"read-payment_type-min","read-payment_type"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return int
     * @Groups({"read-payment_type-min","read-payment_type"})
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return string
     * @Groups({"read-payment_type"})
     */
    public function getAltNames(): string
    {
        return $this->altNames;
    }

    /**
     * @return bool
     * @Groups({"read-payment_type-min","read-payment_type"})
     */
    public function isDefaultIfNotFound(): bool
    {
        return $this->defaultIfNotFound;
    }


}
