<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseProduct;
use App\Util\NumericTypes;
use App\Util\UnitTypes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Product
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Product extends BaseProduct
{
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name = '';
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":"true"})
     */
    private bool $active = true;
    /**
     * @ORM\Column(name="order_seq", type="integer", nullable=false, options={"default":"-1"})
     */
    private int $order = -1;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":"0", "comment":"NumericTypes::INTEGER"})
     */
    private int $numericType = NumericTypes::INTEGER;
    /**
     * @ORM\Column(type="integer", options={"default":"0", "comment": "UnitTypes::LITER"})
     */
    private int $unitType = UnitTypes::LITER;

    /**
     * @ORM\Column(type="text", nullable=false, options={"default":"", "comment": "comma separated alt names"})
     */
    private string $altNames = "";

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "false"})
     */
    private bool $defaultIfNotFound = false;

    /**
     * @var ArrayCollection<ProductCompanyBranch>|ProductCompanyBranch[]|null
     *
     * @ORM\OneToMany(targetEntity="ProductCompanyBranch", mappedBy="product", cascade={"persist"})
     */
    private $productCompanyBranch;

    public function __construct()
    {
        $this->productCompanyBranch = new ArrayCollection();
    }

    /**
     * @return ProductCompanyBranch[]|ArrayCollection|null
     * @Groups({"read-product-relations","read-product-company_branch"})
     */
    public function getProductCompanyBranch()
    {
        return $this->productCompanyBranch;
    }


    /**
     * @return string
     * @Groups({"read-product-min","read-product"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     * @Groups({"read-product-min","read-product"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return int
     * @Groups({"read-product-min","read-product"})
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return int
     * @Groups({"read-product-min","read-product"})
     */
    public function getNumericType(): int
    {
        return $this->numericType;
    }

    /**
     * @return int
     * @Groups({"read-product-min","read-product"})
     */
    public function getUnitType(): int
    {
        return $this->unitType;
    }

    /**
     * @return string
     * @Groups({"read-product"})
     */
    public function getAltNames(): string
    {
        return $this->altNames;
    }

    /**
     * @return bool
     * @Groups({"read-product-min","read-product"})
     */
    public function isDefaultIfNotFound(): bool
    {
        return $this->defaultIfNotFound;
    }

    /**
     * @param string $name
     * @return Product
     * @Groups({"write-product"})
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param bool $active
     * @return Product
     * @Groups({"write-product"})
     */
    public function setActive(bool $active): Product
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param int $order
     * @return Product
     * @Groups({"write-product"})
     */
    public function setOrder(int $order): Product
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param int $numericType
     * @return Product
     * @Groups({"write-product"})
     */
    public function setNumericType(int $numericType): Product
    {
        $this->numericType = $numericType;
        return $this;
    }

    /**
     * @param int $unitType
     * @return Product
     * @Groups({"write-product"})
     */
    public function setUnitType(int $unitType): Product
    {
        $this->unitType = $unitType;
        return $this;
    }

    /**
     * @param string $altNames
     * @return Product
     * @Groups({"write-product"})
     */
    public function setAltNames(string $altNames): Product
    {
        $this->altNames = $altNames;
        return $this;
    }

    /**
     * @param bool $defaultIfNotFound
     * @return Product
     * @Groups({"write-product"})
     */
    public function setDefaultIfNotFound(bool $defaultIfNotFound): Product
    {
        $this->defaultIfNotFound = $defaultIfNotFound;
        return $this;
    }

    /**
     * @param ProductCompanyBranch[]|ArrayCollection|null $productCompanyBranch
     * @return Product
     */
    public function setProductCompanyBranch($productCompanyBranch)
    {
        $this->productCompanyBranch = $productCompanyBranch;
        return $this;
    }



}
