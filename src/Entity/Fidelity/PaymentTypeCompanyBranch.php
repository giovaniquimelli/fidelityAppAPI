<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePaymentTypeCompanyBranch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * PaymentTypeCompanyBranch
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PaymentTypeCompanyBranch extends BasePaymentTypeCompanyBranch
{
    /**
     * @ORM\ManyToOne(targetEntity="PaymentType", inversedBy="paymentTypeCompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private PaymentType $paymentType;
    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CompanyBranch $companyBranch;
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $tax = '0';
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":"true"})
     */
    private bool $active = true;

    /**
     * @return PaymentType
     * @Groups({"read-payment_type_company_branch-min","read-payment_type_company_branch"})
     */
    public function getPaymentType(): PaymentType
    {
        return $this->paymentType;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-payment_type_company_branch-relations","read-payment_type_company_branch-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return string
     * @Groups({"read-payment_type_company_branch-min","read-payment_type_company_branch"})
     */
    public function getTax(): string
    {
        return $this->tax;
    }

    /**
     * @return bool
     * @Groups({"read-payment_type_company_branch-min","read-payment_type_company_branch"})r
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param PaymentType $paymentType
     * @return PaymentTypeCompanyBranch
     */
    public function setPaymentType(PaymentType $paymentType): PaymentTypeCompanyBranch
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return PaymentTypeCompanyBranch
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): PaymentTypeCompanyBranch
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param string $tax
     * @return PaymentTypeCompanyBranch
     */
    public function setTax(string $tax): PaymentTypeCompanyBranch
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @param bool $active
     * @return PaymentTypeCompanyBranch
     */
    public function setActive(bool $active): PaymentTypeCompanyBranch
    {
        $this->active = $active;
        return $this;
    }


}
