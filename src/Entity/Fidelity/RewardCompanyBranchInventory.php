<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseRewardCompanyBranchInventory;
use App\Util\InventoryEntryType;
use App\Util\InventoryItemType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * RewardCompanyBranchInventory
 *
 * @ORM\Entity(repositoryClass="App\Repository\RewardCompanyBranchInventoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RewardCompanyBranchInventory extends BaseRewardCompanyBranchInventory
{
    /**
     * @var Reward
     *
     * @ORM\ManyToOne(targetEntity="Reward")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private Reward $reward;
    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch", inversedBy="rewardCompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private CompanyBranch $companyBranch;
    /**
     * @var TransactionRecord
     *
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?TransactionRecord $transactionRecord;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"deafult":"0", "comment": "InventoryItemType::EXCHANGE"})
     */
    private int $itemType = InventoryItemType::EXCHANGE;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"deafult":"0", "comment": "InventoryEntryType::EXCHANGE"})
     */
    private int $entryType = InventoryEntryType::EXCHANGE;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantityBefore = "0";
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantityAfter = "0";

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantity = "0";

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private ?string $notaFiscal = '';
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $supplier = '';

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPrice = "0";

    /**
     * @return Reward
     */
    public function getReward(): Reward
    {
        return $this->reward;
    }

    /**
     * @param Reward $reward
     */
    public function setReward(Reward $reward): void
    {
        $this->reward = $reward;
    }

    /**
     * @return CompanyBranch
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @param CompanyBranch $companyBranch
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): void
    {
        $this->companyBranch = $companyBranch;
    }

    /**
     * @return TransactionRecord
     */
    public function getTransactionRecord(): TransactionRecord
    {
        return $this->transactionRecord;
    }

    /**
     * @param TransactionRecord $transactionRecord
     */
    public function setTransactionRecord(TransactionRecord $transactionRecord): void
    {
        $this->transactionRecord = $transactionRecord;
    }

    /**
     * @return int
     */
    public function getItemType(): int
    {
        return $this->itemType;
    }

    /**
     * @param int $itemType
     */
    public function setItemType(int $itemType): void
    {
        $this->itemType = $itemType;
    }

    /**
     * @return int
     */
    public function getEntryType(): int
    {
        return $this->entryType;
    }

    /**
     * @param int $entryType
     */
    public function setEntryType(int $entryType): void
    {
        $this->entryType = $entryType;
    }

    /**
     * @return string
     */
    public function getQuantityBefore(): string
    {
        return $this->quantityBefore;
    }

    /**
     * @param string $quantityBefore
     */
    public function setQuantityBefore(string $quantityBefore): void
    {
        $this->quantityBefore = $quantityBefore;
    }

    /**
     * @return string
     */
    public function getQuantityAfter(): string
    {
        return $this->quantityAfter;
    }

    /**
     * @param string $quantityAfter
     */
    public function setQuantityAfter(string $quantityAfter): void
    {
        $this->quantityAfter = $quantityAfter;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string|null
     */
    public function getNotaFiscal(): ?string
    {
        return $this->notaFiscal;
    }

    /**
     * @param string|null $notaFiscal
     */
    public function setNotaFiscal(?string $notaFiscal): void
    {
        $this->notaFiscal = $notaFiscal;
    }

    /**
     * @return string|null
     */
    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    /**
     * @param string|null $supplier
     */
    public function setSupplier(?string $supplier): void
    {
        $this->supplier = $supplier;
    }

    /**
     * @return string
     */
    public function getUnitPrice(): string
    {
        return $this->unitPrice;
    }

    /**
     * @param string $unitPrice
     */
    public function setUnitPrice(string $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }



}
