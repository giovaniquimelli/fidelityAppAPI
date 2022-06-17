<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordExchangeRefReward;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordExchangeRefReward
 *
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRecordExchangeRefRewardRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordExchangeRefReward extends BaseTransactionRecordExchangeRefReward
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;
    /**
     * @ORM\ManyToOne(targetEntity="Reward")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private Reward $reward;
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPoints= '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantity = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=10, nullable=false, options={"default": "0"})
     */
    private string $points = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPrice = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $amount = '0';
    private bool $refund = false;
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $tax = '0';

    /**
     * @return TransactionRecord
     * @Groups({"read-transaction_record_exchange_ref_reward-relations","read-transaction_record_exchange_ref_reward-transaction"})
     */
    public function getTransaction(): TransactionRecord
    {
        return $this->transaction;
    }

    /**
     * @param TransactionRecord $transaction
     */
    public function setTransaction(TransactionRecord $transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return Reward
     * @Groups({"read-transaction_record_exchange_ref_reward-relations","read-transaction_record_exchange_ref_reward-reward"})
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
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward-min","read-transaction_record_exchange_ref_reward"})
     */
    public function getUnitPoints(): string
    {
        return $this->unitPoints;
    }

    /**
     * @param string $unitPoints
     */
    public function setUnitPoints(string $unitPoints): void
    {
        $this->unitPoints = $unitPoints;
    }

    /**
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward-min","read-transaction_record_exchange_ref_reward"})
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
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward-min","read-transaction_record_exchange_ref_reward"})
     */
    public function getPoints(): string
    {
        return $this->points;
    }

    /**
     * @param string $points
     */
    public function setPoints(string $points): void
    {
        $this->points = $points;
    }

    /**
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward"})
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

    /**
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward"})
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return bool
     * @Groups({"read-transaction_record_exchange_ref_reward"})
     */
    public function isRefund(): bool
    {
        return $this->refund;
    }

    /**
     * @param bool $refund
     */
    public function setRefund(bool $refund): void
    {
        $this->refund = $refund;
    }

    /**
     * @return string
     * @Groups({"read-transaction_record_exchange_ref_reward"})
     */
    public function getTax(): string
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     */
    public function setTax(string $tax): void
    {
        $this->tax = $tax;
    }


}
