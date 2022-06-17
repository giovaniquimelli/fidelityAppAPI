<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceBilling;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceBilling
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceBilling extends BaseFinanceBilling
{
    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=22, scale=2, nullable=false, options={"comment"="valor total sem desconto"})
     */
    private $amount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="amount_with_discount", type="decimal", precision=22, scale=2, nullable=false, options={"comment"="valor com o desconto calculado"})
     */
    private $amountWithDiscount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=22, scale=2, nullable=false, options={"comment"="valor do desconto"})
     */
    private $discount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="valor_desconto", type="decimal", precision=22, scale=2, nullable=false, options={"comment"="desconto aplicado na operacao -> para registro"})
     */
    private $valorDesconto = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="valor_pago", type="decimal", precision=22, scale=2, nullable=true)
     */
    private $valorPago = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_pontualidade", type="date", nullable=false)
     */
    private $dataPontualidade;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_emisao", type="datetime", nullable=false)
     */
    private $dataEmisao;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="process_date", type="datetime", nullable=false)
     */
    private $processDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="due_date", type="datetime", nullable=false)
     */
    private $dueDate;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="payment_date", type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="termination_date", type="datetime", nullable=true)
     */
    private $terminationDate;

    /**
     * @var int
     *
     * @ORM\Column(name="situacao", type="integer", nullable=false)
     */
    private $situacao;

    /**
     * @var int
     *
     * @ORM\Column(name="type_documento", type="integer", nullable=false, options={"comment"="especie, boleto, duplicata, cheque, promissoria, vale, cartao de credito, debito"})
     */
    private $typeDocumento;

    /**
     * @var int
     *
     * @ORM\Column(name="type_conta", type="integer", nullable=false, options={"comment"="pagar/receber"})
     */
    private $typeConta;

    /**
     * @var bool
     *
     * @ORM\Column(name="conciliado", type="boolean", nullable=false)
     */
    private $conciliado = false;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="data_conciliacao", type="datetime", nullable=true)
     */
    private $dataConciliacao;

    /**
     * @var int
     *
     * @ORM\Column(name="type_nota", type="integer", nullable=false)
     */
    private $typeNota;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_nota", type="string", length=255, nullable=true)
     */
    private $numeroNota;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     */
    private $observacao;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacoes_cancelamento", type="text", nullable=true)
     */
    private $observacoesCancelamento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="recibo", type="text", nullable=true)
     */
    private $recibo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cod_transacao", type="string", length=255, nullable=true)
     */
    private $codTransacao;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nosso_numero", type="string", length=255, nullable=true)
     */
    private $nossoNumero;


    /**
     * @var FinanceCostCenter
     *
     * @ORM\ManyToOne(targetEntity="FinanceCostCenter")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeCostCenter;

    /**
     * @var FinanceAccountPlan
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountPlan")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountPlan;

    /**
     * @var FinanceBankAccount
     *
     * @ORM\ManyToOne(targetEntity="FinanceBankAccount")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeBankAccount;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $idPersonOwner;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;

    /**
     * @var FinanceAccountType
     *
     * @ORM\ManyToOne(targetEntity="FinanceAccountType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeAccountType;

    /**
     * @var FinancePaymentType
     *
     * @ORM\ManyToOne(targetEntity="FinancePaymentType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financePaymentType;

    /**
     * @var CommonCancellationReason
     *
     * @ORM\ManyToOne(targetEntity="CommonCancellationReason")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $commonCancellationReason;


    //region Getters

    /**
     * @return string
     * @Groups({"read-finance_billing"})
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     * @Groups({"read-finance_billing"})
     */
    public function getAmountWithDiscount(): string
    {
        return $this->amountWithDiscount;
    }

    /**
     * @return string
     * @Groups({"read-finance_billing"})
     */
    public function getDiscount(): string
    {
        return $this->discount;
    }

    /**
     * @return string
     * @Groups({"read-finance_billing"})
     */
    public function getValorDesconto(): string
    {
        return $this->valorDesconto;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getValorPago(): ?string
    {
        return $this->valorPago;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_billing"})
     */
    public function getDataPontualidade(): DateTime
    {
        return $this->dataPontualidade;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_billing"})
     */
    public function getDataEmisao(): DateTime
    {
        return $this->dataEmisao;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_billing"})
     */
    public function getProcessDate(): DateTime
    {
        return $this->processDate;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_billing"})
     */
    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-finance_billing"})
     */
    public function getPaymentDate(): ?DateTime
    {
        return $this->paymentDate;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-finance_billing"})
     */
    public function getTerminationDate(): ?DateTime
    {
        return $this->terminationDate;
    }

    /**
     * @return int
     * @Groups({"read-finance_billing"})
     */
    public function getSituacao(): int
    {
        return $this->situacao;
    }

    /**
     * @return int
     * @Groups({"read-finance_billing"})
     */
    public function getTypeDocumento(): int
    {
        return $this->typeDocumento;
    }

    /**
     * @return int
     * @Groups({"read-finance_billing"})
     */
    public function getTypeConta(): int
    {
        return $this->typeConta;
    }

    /**
     * @return bool
     * @Groups({"read-finance_billing"})
     */
    public function getConciliado(): bool
    {
        return $this->conciliado;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-finance_billing"})
     */
    public function getDataConciliacao(): ?DateTime
    {
        return $this->dataConciliacao;
    }

    /**
     * @return int
     * @Groups({"read-finance_billing"})
     */
    public function getTypeNota(): int
    {
        return $this->typeNota;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getNumeroNota(): ?string
    {
        return $this->numeroNota;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getObservacoesCancelamento(): ?string
    {
        return $this->observacoesCancelamento;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getRecibo(): ?string
    {
        return $this->recibo;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getCodTransacao(): ?string
    {
        return $this->codTransacao;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_billing"})
     */
    public function getNossoNumero(): ?string
    {
        return $this->nossoNumero;
    }

    /**
     * @return FinanceCostCenter
     * @Groups({"read-finance_billing-relations","read-finance_billing-finance_cost_center"})
     */
    public function getFinanceCostCenter(): FinanceCostCenter
    {
        return $this->financeCostCenter;
    }

    /**
     * @return FinanceAccountPlan
     * @Groups({"read-finance_billing-relations","read-finance_billing-finance_account_plan"})
     */
    public function getFinanceAccountPlan(): FinanceAccountPlan
    {
        return $this->financeAccountPlan;
    }

    /**
     * @return FinanceBankAccount
     * @Groups({"read-finance_billing-relations","read-finance_billing-finance_bank_account"})
     */
    public function getFinanceBankAccount(): FinanceBankAccount
    {
        return $this->financeBankAccount;
    }

    /**
     * @return Person
     * @Groups({"read-finance_billing-relations","read-finance_billing-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return Person
     * @Groups({"read-finance_billing-relations","read-finance_billing-person"})
     */
    public function getIdPersonOwner(): Person
    {
        return $this->idPersonOwner;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-finance_billing-relations","read-finance_billing-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return FinanceAccountType
     * @Groups({"read-finance_billing-relations","read-finance_billing-finance_account_type"})
     */
    public function getFinanceAccountType(): FinanceAccountType
    {
        return $this->financeAccountType;
    }

    /**
     * @return FinancePaymentType
     * @Groups({"read-finance_billing-relations","read-finance_billing-finance_payment_type"})
     */
    public function getFinancePaymentType(): FinancePaymentType
    {
        return $this->financePaymentType;
    }

    /**
     * @return CommonCancellationReason
     * @Groups({"read-finance_billing-relations","read-finance_billing-common_cancellation_reason"})
     */
    public function getCommonCancellationReason(): CommonCancellationReason
    {
        return $this->commonCancellationReason;
    }
    //endregion

    //region Setters
    /**
     * @param string $amount
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setAmount(string $amount): FinanceBilling
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $amountWithDiscount
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setAmountWithDiscount(string $amountWithDiscount): FinanceBilling
    {
        $this->amountWithDiscount = $amountWithDiscount;
        return $this;
    }

    /**
     * @param string $discount
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setDiscount(string $discount): FinanceBilling
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @param string $valorDesconto
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setValorDesconto(string $valorDesconto): FinanceBilling
    {
        $this->valorDesconto = $valorDesconto;
        return $this;
    }

    /**
     * @param string|null $valorPago
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setValorPago(?string $valorPago): FinanceBilling
    {
        $this->valorPago = $valorPago;
        return $this;
    }

    /**
     * @param DateTime $dataPontualidade
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setDataPontualidade(DateTime $dataPontualidade): FinanceBilling
    {
        $this->dataPontualidade = $dataPontualidade;
        return $this;
    }

    /**
     * @param DateTime $dataEmisao
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setDataEmisao(DateTime $dataEmisao): FinanceBilling
    {
        $this->dataEmisao = $dataEmisao;
        return $this;
    }

    /**
     * @param DateTime $processDate
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setProcessDate(DateTime $processDate): FinanceBilling
    {
        $this->processDate = $processDate;
        return $this;
    }

    /**
     * @param DateTime $dueDate
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setDueDate(DateTime $dueDate): FinanceBilling
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param DateTime|null $paymentDate
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setPaymentDate(?DateTime $paymentDate): FinanceBilling
    {
        $this->paymentDate = $paymentDate;
        return $this;
    }

    /**
     * @param DateTime|null $terminationDate
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setTerminationDate(?DateTime $terminationDate): FinanceBilling
    {
        $this->terminationDate = $terminationDate;
        return $this;
    }

    /**
     * @param int $situacao
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setSituacao(int $situacao): FinanceBilling
    {
        $this->situacao = $situacao;
        return $this;
    }

    /**
     * @param int $typeDocumento
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setTypeDocumento(int $typeDocumento): FinanceBilling
    {
        $this->typeDocumento = $typeDocumento;
        return $this;
    }

    /**
     * @param int $typeConta
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setTypeConta(int $typeConta): FinanceBilling
    {
        $this->typeConta = $typeConta;
        return $this;
    }

    /**
     * @param bool $conciliado
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setConciliado(bool $conciliado): FinanceBilling
    {
        $this->conciliado = $conciliado;
        return $this;
    }

    /**
     * @param DateTime|null $dataConciliacao
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setDataConciliacao(?DateTime $dataConciliacao): FinanceBilling
    {
        $this->dataConciliacao = $dataConciliacao;
        return $this;
    }

    /**
     * @param int $typeNota
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setTypeNota(int $typeNota): FinanceBilling
    {
        $this->typeNota = $typeNota;
        return $this;
    }

    /**
     * @param string|null $numeroNota
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setNumeroNota(?string $numeroNota): FinanceBilling
    {
        $this->numeroNota = $numeroNota;
        return $this;
    }

    /**
     * @param string|null $observacao
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setObservacao(?string $observacao): FinanceBilling
    {
        $this->observacao = $observacao;
        return $this;
    }

    /**
     * @param string|null $observacoesCancelamento
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setObservacoesCancelamento(?string $observacoesCancelamento): FinanceBilling
    {
        $this->observacoesCancelamento = $observacoesCancelamento;
        return $this;
    }

    /**
     * @param string|null $recibo
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setRecibo(?string $recibo): FinanceBilling
    {
        $this->recibo = $recibo;
        return $this;
    }

    /**
     * @param string|null $codTransacao
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setCodTransacao(?string $codTransacao): FinanceBilling
    {
        $this->codTransacao = $codTransacao;
        return $this;
    }

    /**
     * @param string|null $nossoNumero
     * @return FinanceBilling
     * @Groups({"write-finance_billing"})
     */
    public function setNossoNumero(?string $nossoNumero): FinanceBilling
    {
        $this->nossoNumero = $nossoNumero;
        return $this;
    }

    /**
     * @param FinanceCostCenter $financeCostCenter
     * @return FinanceBilling
     */
    public function setFinanceCostCenter(FinanceCostCenter $financeCostCenter): FinanceBilling
    {
        $this->financeCostCenter = $financeCostCenter;
        return $this;
    }

    /**
     * @param FinanceAccountPlan $financeAccountPlan
     * @return FinanceBilling
     */
    public function setFinanceAccountPlan(FinanceAccountPlan $financeAccountPlan): FinanceBilling
    {
        $this->financeAccountPlan = $financeAccountPlan;
        return $this;
    }

    /**
     * @param FinanceBankAccount $financeBankAccount
     * @return FinanceBilling
     */
    public function setFinanceBankAccount(FinanceBankAccount $financeBankAccount): FinanceBilling
    {
        $this->financeBankAccount = $financeBankAccount;
        return $this;
    }

    /**
     * @param Person $person
     * @return FinanceBilling
     */
    public function setPerson(Person $person): FinanceBilling
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param Person $idPersonOwner
     * @return FinanceBilling
     */
    public function setIdPersonOwner(Person $idPersonOwner): FinanceBilling
    {
        $this->idPersonOwner = $idPersonOwner;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return FinanceBilling
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): FinanceBilling
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param FinanceAccountType $financeAccountType
     * @return FinanceBilling
     */
    public function setFinanceAccountType(FinanceAccountType $financeAccountType): FinanceBilling
    {
        $this->financeAccountType = $financeAccountType;
        return $this;
    }

    /**
     * @param FinancePaymentType $financePaymentType
     * @return FinanceBilling
     */
    public function setFinancePaymentType(FinancePaymentType $financePaymentType): FinanceBilling
    {
        $this->financePaymentType = $financePaymentType;
        return $this;
    }

    /**
     * @param CommonCancellationReason $commonCancellationReason
     * @return FinanceBilling
     */
    public function setCommonCancellationReason(CommonCancellationReason $commonCancellationReason): FinanceBilling
    {
        $this->commonCancellationReason = $commonCancellationReason;
        return $this;
    }
    //endregion
}
