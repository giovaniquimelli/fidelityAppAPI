<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecord;
use App\Util\TransactionRecordEntryType;
use App\Util\TransactionRecordLockType;
use App\Util\TransactionRecordStatusType;
use App\Util\TransactionRecordType;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecord
 *
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRecordRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecord extends BaseTransactionRecord
{
    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private Account $account;
    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?Account $subAccount;
    /**
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?CompanyBranch $companyBranch;
    /**
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?Users $employee;
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private ?TransactionRecord $transaction;

    //   T   B   M   T
    // 888.888.888.888.888,8888888888
    /**
     * @ORM\Column(type="decimal", precision=25, scale=10, nullable=false, options={"default": "0"})
     */
    private string $points = '0';
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "TransactionRecordType::PURCHASE"})
     */
    private int $transactionType = TransactionRecordType::PURCHASE;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "TransactionRecordEntryType::AUTOMATED"})
     */
    private int $entryType = TransactionRecordEntryType::AUTOMATED;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "TransactionRecordStatusType::OK"})
     */
    private int $transactionStatus = TransactionRecordStatusType::OK;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $notaFiscal = '';
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $purchaseUUID = '';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $localDateTime;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $posVersion = '';
    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $appVersion = '';

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "false"})
     */
    private bool $locked = false;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": "0", "comment": "TransactionRecordLockType::NOT_LOCKED"})
     */
    private int $lockType = TransactionRecordLockType::NOT_LOCKED;

    /**
     * @ORM\Column(name="code", type="string", length=20, nullable=true)
     */
    private ?string $code = '';

    /**
     * @return Account
     * @Groups({"read-transaction_record-relations","read-transaction_record-account"})
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return Account|null
     * @Groups({"read-transaction_record-relations","read-transaction_record-sub_account"})
     */
    public function getSubAccount(): ?Account
    {
        return $this->subAccount;
    }

    /**
     * @param Account|null $subAccount
     */
    public function setSubAccount(?Account $subAccount): void
    {
        $this->subAccount = $subAccount;
    }

    /**
     * @return CompanyBranch|null
     * @Groups({"read-transaction_record-relations","read-transaction_record-company_branch"})
     */
    public function getCompanyBranch(): ?CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @param CompanyBranch|null $companyBranch
     */
    public function setCompanyBranch(?CompanyBranch $companyBranch): void
    {
        $this->companyBranch = $companyBranch;
    }

    /**
     * @return Users|null
     * @Groups({"read-transaction_record-relations","read-transaction_record-employee"})
     */
    public function getEmployee(): ?Users
    {
        return $this->employee;
    }

    /**
     * @param Users|null $employee
     */
    public function setEmployee(?Users $employee): void
    {
        $this->employee = $employee;
    }

    /**
     * @return TransactionRecord|null
     * @Groups({"read-transaction_record-relations","read-transaction_record-transaction"})
     */
    public function getTransaction(): ?TransactionRecord
    {
        return $this->transaction;
    }

    /**
     * @param TransactionRecord|null $transaction
     */
    public function setTransaction(?TransactionRecord $transaction): void
    {
        $this->transaction = $transaction;
    }

    /**
     * @return string
     * @Groups({"read-transaction_record-min","read-transaction_record"})
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
     * @return int
     * @Groups({"read-transaction_record-min","read-transaction_record"})
     */
    public function getTransactionType(): int
    {
        return $this->transactionType;
    }

    /**
     * @param int $transactionType
     */
    public function setTransactionType(int $transactionType): void
    {
        $this->transactionType = $transactionType;
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
     * @return int
     */
    public function getTransactionStatus(): int
    {
        return $this->transactionStatus;
    }

    /**
     * @param int $transactionStatus
     */
    public function setTransactionStatus(int $transactionStatus): void
    {
        $this->transactionStatus = $transactionStatus;
    }

    /**
     * @return string
     */
    public function getNotaFiscal(): string
    {
        return $this->notaFiscal;
    }

    /**
     * @param string $notaFiscal
     */
    public function setNotaFiscal(string $notaFiscal): void
    {
        $this->notaFiscal = $notaFiscal;
    }

    /**
     * @return string
     */
    public function getPurchaseUUID(): string
    {
        return $this->purchaseUUID;
    }

    /**
     * @param string $purchaseUUID
     */
    public function setPurchaseUUID(string $purchaseUUID): void
    {
        $this->purchaseUUID = $purchaseUUID;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-transaction_record-min","read-transaction_record"})
     */
    public function getLocalDateTime(): ?DateTime
    {
        return $this->localDateTime;
    }

    /**
     * @param DateTime|null $localDateTime
     */
    public function setLocalDateTime(?DateTime $localDateTime): void
    {
        $this->localDateTime = $localDateTime;
    }

    /**
     * @return string
     */
    public function getPosVersion(): string
    {
        return $this->posVersion;
    }

    /**
     * @param string $posVersion
     */
    public function setPosVersion(string $posVersion): void
    {
        $this->posVersion = $posVersion;
    }

    /**
     * @return string
     */
    public function getAppVersion(): string
    {
        return $this->appVersion;
    }

    /**
     * @param string $appVersion
     */
    public function setAppVersion(string $appVersion): void
    {
        $this->appVersion = $appVersion;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    /**
     * @return int
     */
    public function getLockType(): int
    {
        return $this->lockType;
    }

    /**
     * @param int $lockType
     */
    public function setLockType(int $lockType): void
    {
        $this->lockType = $lockType;
    }

    /**
     * @return string|null
     * @Groups({"read-transaction_record-min","read-transaction_record"})
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
