<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordExchange;
use App\Util\TransactionRecordExchangeStatusType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordExchange
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordExchange extends BaseTransactionRecordExchange
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;

    /**
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private ?int $status = TransactionRecordExchangeStatusType::PENDING;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=10, nullable=false, options={"default": "0"})
     */
    private string $points = '0';

    // status atual da transacao
    //

    /**
     * @return TransactionRecord
     */
    public function getTransaction(): TransactionRecord
    {
        return $this->transaction;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param TransactionRecord $transaction
     */
    public function setTransaction(TransactionRecord $transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return string
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



}
