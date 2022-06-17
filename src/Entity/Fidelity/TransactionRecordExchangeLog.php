<?php

namespace App\Entity\Fidelity;

use App\Entity\Fidelity\Base\BaseTransactionRecordExchangeRewardLog;
use App\Entity\Fidelity\TransactionRecord;
use App\Util\TransactionRecordExchangeStatusType;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordExchangeLog extends BaseTransactionRecordExchangeRewardLog
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(nullable=false)
     */
    private TransactionRecord $transaction;

    private int $status = TransactionRecordExchangeStatusType::PENDING;

    /**
     * @var DateTime
     * @ORM\Column(name="changedAt", type="datetime", nullable=false)
     */
    private ?DateTime $changedAt;

    /**
     * @ORM\Column(name="remarks", type="text", nullable=true)
     */
    private ?string $remarks = '';

    /**
     * @return \App\Entity\Fidelity\TransactionRecord
     */
    public function getTransaction(): \App\Entity\Fidelity\TransactionRecord
    {
        return $this->transaction;
    }

    /**
     * @param \App\Entity\Fidelity\TransactionRecord $transaction
     */
    public function setTransaction(\App\Entity\Fidelity\TransactionRecord $transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return DateTime
     */
    public function getChangedAt(): DateTime
    {
        return $this->changedAt;
    }

    /**
     * @param DateTime $changedAt
     */
    public function setChangedAt(DateTime $changedAt): void
    {
        $this->changedAt = $changedAt;
    }

    /**
     * @return string|null
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * @param string|null $remarks
     */
    public function setRemarks(?string $remarks): void
    {
        $this->remarks = $remarks;
    }



}
