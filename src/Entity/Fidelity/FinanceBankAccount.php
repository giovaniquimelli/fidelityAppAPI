<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceBankAccount;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceBankAccount
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceBankAccount extends BaseFinanceBankAccount
{
    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_default", type="boolean", nullable=true)
     */
    private $isDefault = false;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_name", type="string", length=255, nullable=true)
     */
    private $accountName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="custom_name", type="string", length=255, nullable=true)
     */
    private $customName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="beneficiary_name", type="string", length=255, nullable=true)
     */
    private $beneficiaryName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="beneficiary_cpf_cnpj", type="string", length=255, nullable=true)
     */
    private $beneficiaryCpfCnpj;

    /**
     * @var string|null
     *
     * @ORM\Column(name="beneficiary_address", type="string", length=255, nullable=true)
     */
    private $beneficiaryAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agency_number", type="string", length=255, nullable=true)
     */
    private $agencyNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agency_digit", type="string", length=255, nullable=true)
     */
    private $agencyDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_number", type="string", length=255, nullable=true)
     */
    private $accountNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_digit", type="string", length=255, nullable=true)
     */
    private $accountDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra1", type="string", length=255, nullable=true)
     */
    private $extra1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra1_digit", type="string", length=255, nullable=true)
     */
    private $extra1Digit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra2", type="string", length=255, nullable=true)
     */
    private $extra2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra2_digit", type="string", length=255, nullable=true)
     */
    private $extra2Digit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extra3", type="string", length=255, nullable=true)
     */
    private $extra3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="wallet_code", type="string", length=255, nullable=true)
     */
    private $walletCode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="next_remittance_number", type="integer", nullable=true)
     */
    private $nextRemittanceNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="next_our_number", type="integer", nullable=true)
     */
    private $nextOurNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cnab_type", type="string", length=255, nullable=true)
     */
    private $cnabType;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enable_banking_billet", type="boolean", nullable=true)
     */
    private $enableBankingBillet = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enable_check_custody", type="boolean", nullable=true)
     */
    private $enableCheckCustody = false;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="certified_at", type="datetime", nullable=true)
     */
    private $certifiedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="certified_by", type="string", length=255, nullable=false)
     */
    private $certifiedBy;


    /**
     * @var Bank
     *
     * @ORM\ManyToOne(targetEntity="Bank")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $bank;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;

    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;

    /**
     * @var FinanceCostCenter
     *
     * @ORM\ManyToOne(targetEntity="FinanceCostCenter")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeCostCenter;


    //region Getters

    /**
     * @return bool|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @return int
     * @Groups({"read-finance_bank_account"})
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getCustomName(): ?string
    {
        return $this->customName;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getBeneficiaryName(): ?string
    {
        return $this->beneficiaryName;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getBeneficiaryCpfCnpj(): ?string
    {
        return $this->beneficiaryCpfCnpj;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getBeneficiaryAddress(): ?string
    {
        return $this->beneficiaryAddress;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getAgencyNumber(): ?string
    {
        return $this->agencyNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getAgencyDigit(): ?string
    {
        return $this->agencyDigit;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getAccountDigit(): ?string
    {
        return $this->accountDigit;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getExtra1(): ?string
    {
        return $this->extra1;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getExtra1Digit(): ?string
    {
        return $this->extra1Digit;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getExtra2(): ?string
    {
        return $this->extra2;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getExtra2Digit(): ?string
    {
        return $this->extra2Digit;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getExtra3(): ?string
    {
        return $this->extra3;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getWalletCode(): ?string
    {
        return $this->walletCode;
    }

    /**
     * @return int|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getNextRemittanceNumber(): ?int
    {
        return $this->nextRemittanceNumber;
    }

    /**
     * @return int|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getNextOurNumber(): ?int
    {
        return $this->nextOurNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getCnabType(): ?string
    {
        return $this->cnabType;
    }

    /**
     * @return bool|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getEnableBankingBillet(): ?bool
    {
        return $this->enableBankingBillet;
    }

    /**
     * @return bool|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getEnableCheckCustody(): ?bool
    {
        return $this->enableCheckCustody;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-finance_bank_account"})
     */
    public function getCertifiedAt(): ?DateTime
    {
        return $this->certifiedAt;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_account"})
     */
    public function getCertifiedBy(): string
    {
        return $this->certifiedBy;
    }

    /**
     * @return Bank
     * @Groups({"read-finance_bank_account-relations","read-finance_bank_account-bank"})
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-finance_bank_account-relations","read-finance_bank_account-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_bank_account-relations","read-finance_bank_account-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }

    /**
     * @return FinanceCostCenter
     * @Groups({"read-finance_bank_account-relations","read-finance_bank_account-finance_cost_center"})
     */
    public function getFinanceCostCenter(): FinanceCostCenter
    {
        return $this->financeCostCenter;
    }
    //endregion

    //region Setters
    /**
     * @param bool|null $isDefault
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setIsDefault(?bool $isDefault): FinanceBankAccount
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * @param int $status
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setStatus(int $status): FinanceBankAccount
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string|null $accountName
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setAccountName(?string $accountName): FinanceBankAccount
    {
        $this->accountName = $accountName;
        return $this;
    }

    /**
     * @param string|null $customName
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setCustomName(?string $customName): FinanceBankAccount
    {
        $this->customName = $customName;
        return $this;
    }

    /**
     * @param string|null $beneficiaryName
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setBeneficiaryName(?string $beneficiaryName): FinanceBankAccount
    {
        $this->beneficiaryName = $beneficiaryName;
        return $this;
    }

    /**
     * @param string|null $beneficiaryCpfCnpj
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setBeneficiaryCpfCnpj(?string $beneficiaryCpfCnpj): FinanceBankAccount
    {
        $this->beneficiaryCpfCnpj = $beneficiaryCpfCnpj;
        return $this;
    }

    /**
     * @param string|null $beneficiaryAddress
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setBeneficiaryAddress(?string $beneficiaryAddress): FinanceBankAccount
    {
        $this->beneficiaryAddress = $beneficiaryAddress;
        return $this;
    }

    /**
     * @param string|null $agencyNumber
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setAgencyNumber(?string $agencyNumber): FinanceBankAccount
    {
        $this->agencyNumber = $agencyNumber;
        return $this;
    }

    /**
     * @param string|null $agencyDigit
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setAgencyDigit(?string $agencyDigit): FinanceBankAccount
    {
        $this->agencyDigit = $agencyDigit;
        return $this;
    }

    /**
     * @param string|null $accountNumber
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setAccountNumber(?string $accountNumber): FinanceBankAccount
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param string|null $accountDigit
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setAccountDigit(?string $accountDigit): FinanceBankAccount
    {
        $this->accountDigit = $accountDigit;
        return $this;
    }

    /**
     * @param string|null $extra1
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setExtra1(?string $extra1): FinanceBankAccount
    {
        $this->extra1 = $extra1;
        return $this;
    }

    /**
     * @param string|null $extra1Digit
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setExtra1Digit(?string $extra1Digit): FinanceBankAccount
    {
        $this->extra1Digit = $extra1Digit;
        return $this;
    }

    /**
     * @param string|null $extra2
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setExtra2(?string $extra2): FinanceBankAccount
    {
        $this->extra2 = $extra2;
        return $this;
    }

    /**
     * @param string|null $extra2Digit
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setExtra2Digit(?string $extra2Digit): FinanceBankAccount
    {
        $this->extra2Digit = $extra2Digit;
        return $this;
    }

    /**
     * @param string|null $extra3
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setExtra3(?string $extra3): FinanceBankAccount
    {
        $this->extra3 = $extra3;
        return $this;
    }

    /**
     * @param string|null $walletCode
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setWalletCode(?string $walletCode): FinanceBankAccount
    {
        $this->walletCode = $walletCode;
        return $this;
    }

    /**
     * @param int|null $nextRemittanceNumber
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setNextRemittanceNumber(?int $nextRemittanceNumber): FinanceBankAccount
    {
        $this->nextRemittanceNumber = $nextRemittanceNumber;
        return $this;
    }

    /**
     * @param int|null $nextOurNumber
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setNextOurNumber(?int $nextOurNumber): FinanceBankAccount
    {
        $this->nextOurNumber = $nextOurNumber;
        return $this;
    }

    /**
     * @param string|null $cnabType
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setCnabType(?string $cnabType): FinanceBankAccount
    {
        $this->cnabType = $cnabType;
        return $this;
    }

    /**
     * @param bool|null $enableBankingBillet
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setEnableBankingBillet(?bool $enableBankingBillet): FinanceBankAccount
    {
        $this->enableBankingBillet = $enableBankingBillet;
        return $this;
    }

    /**
     * @param bool|null $enableCheckCustody
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setEnableCheckCustody(?bool $enableCheckCustody): FinanceBankAccount
    {
        $this->enableCheckCustody = $enableCheckCustody;
        return $this;
    }

    /**
     * @param DateTime|null $certifiedAt
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setCertifiedAt(?DateTime $certifiedAt): FinanceBankAccount
    {
        $this->certifiedAt = $certifiedAt;
        return $this;
    }

    /**
     * @param string $certifiedBy
     * @return FinanceBankAccount
     * @Groups({"write-finance_bank_account"})
     */
    public function setCertifiedBy(string $certifiedBy): FinanceBankAccount
    {
        $this->certifiedBy = $certifiedBy;
        return $this;
    }

    /**
     * @param Bank $bank
     * @return FinanceBankAccount
     */
    public function setBank(Bank $bank): FinanceBankAccount
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return FinanceBankAccount
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): FinanceBankAccount
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceBankAccount
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceBankAccount
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }

    /**
     * @param FinanceCostCenter $financeCostCenter
     * @return FinanceBankAccount
     */
    public function setFinanceCostCenter(FinanceCostCenter $financeCostCenter): FinanceBankAccount
    {
        $this->financeCostCenter = $financeCostCenter;
        return $this;
    }
    //endregion
}
