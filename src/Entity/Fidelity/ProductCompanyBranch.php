<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseProductCompanyBranch;
use App\Util\PointByTypes;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * ProductCompanyBranch
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ProductCompanyBranch extends BaseProductCompanyBranch
{
    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private Product $product;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private CompanyBranch $companyBranch;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantity= "0";
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $point = "0";
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $indicationPoint = "0";
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "false"})
     */
    private bool $indicationPercentage = false;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $price = "0";

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $active = true;

    // config
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "-1"})
     */
    private string $minAmount = "-1";
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "-1"})
     */
    private string $maxAmount = "-1";
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $visiblePOS = true;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "PointByTypes::AMOUNT"})
     */
    private int $pointsByManual = PointByTypes::AMOUNT;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "PointByTypes::AMOUNT"})
     */
    private int $pointsByIntegration = PointByTypes::AMOUNT;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0"})
     */
    private float $percentageForIndication = 0;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "false"})
     */
    private bool $paymentTypeFee = false;

    public function __construct()
    {
        $this->product = new Product();
        $this->companyBranch = new CompanyBranch();
    }

    /**
     * @return Product
     * @Groups({"read-product_company_branch-relations","read-product_company_branch-product"})
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-product_company_branch-relations","read-product_company_branch-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getPoint(): string
    {
        return $this->point;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getIndicationPoint(): string
    {
        return $this->indicationPoint;
    }

    /**
     * @return bool
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function isIndicationPercentage(): bool
    {
        return $this->indicationPercentage;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return bool
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getMinAmount(): string
    {
        return $this->minAmount;
    }

    /**
     * @return string
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getMaxAmount(): string
    {
        return $this->maxAmount;
    }

    /**
     * @return bool
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function isVisiblePOS(): bool
    {
        return $this->visiblePOS;
    }

    /**
     * @return int
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getPointsByManual(): int
    {
        return $this->pointsByManual;
    }

    /**
     * @return int
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getPointsByIntegration(): int
    {
        return $this->pointsByIntegration;
    }

    /**
     * @return float|int
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function getPercentageForIndication()
    {
        return $this->percentageForIndication;
    }

    /**
     * @return bool
     * @Groups({"read-product_company_branch-min","read-product_company_branch"})
     */
    public function isPaymentTypeFee(): bool
    {
        return $this->paymentTypeFee;
    }

    /**
     * @param Product $product
     * @return ProductCompanyBranch
     */
    public function setProduct(Product $product): ProductCompanyBranch
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return ProductCompanyBranch
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): ProductCompanyBranch
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param string $quantity
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setQuantity(string $quantity): ProductCompanyBranch
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param string $point
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPoint(string $point): ProductCompanyBranch
    {
        $this->point = $point;
        return $this;
    }

    /**
     * @param string $indicationPoint
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setIndicationPoint(string $indicationPoint): ProductCompanyBranch
    {
        $this->indicationPoint = $indicationPoint;
        return $this;
    }

    /**
     * @param bool $indicationPercentage
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setIndicationPercentage(bool $indicationPercentage): ProductCompanyBranch
    {
        $this->indicationPercentage = $indicationPercentage;
        return $this;
    }

    /**
     * @param string $price
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPrice(string $price): ProductCompanyBranch
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param bool $active
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setActive(bool $active): ProductCompanyBranch
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param string $minAmount
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setMinAmount(string $minAmount): ProductCompanyBranch
    {
        $this->minAmount = $minAmount;
        return $this;
    }

    /**
     * @param string $maxAmount
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setMaxAmount(string $maxAmount): ProductCompanyBranch
    {
        $this->maxAmount = $maxAmount;
        return $this;
    }

    /**
     * @param bool $visiblePOS
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setVisiblePOS(bool $visiblePOS): ProductCompanyBranch
    {
        $this->visiblePOS = $visiblePOS;
        return $this;
    }

    /**
     * @param int $pointsByManual
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPointsByManual(int $pointsByManual): ProductCompanyBranch
    {
        $this->pointsByManual = $pointsByManual;
        return $this;
    }

    /**
     * @param int $pointsByIntegration
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPointsByIntegration(int $pointsByIntegration): ProductCompanyBranch
    {
        $this->pointsByIntegration = $pointsByIntegration;
        return $this;
    }

    /**
     * @param float|int $percentageForIndication
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPercentageForIndication($percentageForIndication)
    {
        $this->percentageForIndication = $percentageForIndication;
        return $this;
    }

    /**
     * @param bool $paymentTypeFee
     * @return ProductCompanyBranch
     * @Groups({"write-product_company_branch"})
     */
    public function setPaymentTypeFee(bool $paymentTypeFee): ProductCompanyBranch
    {
        $this->paymentTypeFee = $paymentTypeFee;
        return $this;
    }

}
