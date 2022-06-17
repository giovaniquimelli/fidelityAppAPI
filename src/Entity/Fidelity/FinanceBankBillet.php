<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceBankBillet;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceBankBillet
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceBankBillet extends BaseFinanceBankBillet
{
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="guid", nullable=false)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sequence", type="string", length=255, nullable=true)
     */
    private $sequence;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount", type="decimal", precision=22, scale=2, nullable=true)
     */
    private $amount = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="paid_amount", type="decimal", precision=22, scale=2, nullable=true)
     */
    private $paidAmount = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="discount_type", type="integer", nullable=false)
     */
    private $discountType;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_value", type="decimal", precision=22, scale=2, nullable=false)
     */
    private $discountValue = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="discount_percentage", type="decimal", precision=22, scale=2, nullable=false)
     */
    private $discountPercentage = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="days_for_discount", type="integer", nullable=false)
     */
    private $daysForDiscount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta", type="text", nullable=false)
     */
    private $meta;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=false)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="instructions", type="text", nullable=false)
     */
    private $instructions;

    /**
     * @var string
     *
     * @ORM\Column(name="document_type", type="string", length=255, nullable=false)
     */
    private $documentType;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="document_date", type="date", nullable=false)
     */
    private $documentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="document_number", type="string", length=255, nullable=false)
     */
    private $documentNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line", type="string", length=255, nullable=true, options={"comment"="linha digitavel"})
     */
    private $line;

    /**
     * @var int|null
     *
     * @ORM\Column(name="our_number", type="integer", nullable=true)
     */
    private $ourNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="our_number_with_digit", type="string", length=255, nullable=true)
     */
    private $ourNumberWithDigit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="our_number_formatted", type="string", length=255, nullable=true)
     */
    private $ourNumberFormatted;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="due_date", type="date", nullable=false)
     */
    private $dueDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="initial_due_date", type="date", nullable=false)
     */
    private $initialDueDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="paid_date", type="date", nullable=false)
     */
    private $paidDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_banco", type="string", length=255, nullable=false)
     */
    private $codBanco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agencia", type="string", length=255, nullable=true)
     */
    private $agencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agencia_digito", type="string", length=255, nullable=true)
     */
    private $agenciaDigito;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conta", type="string", length=255, nullable=true)
     */
    private $conta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conta_digito", type="string", length=255, nullable=true)
     */
    private $contaDigito;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="desconto_pontualidade_type", type="integer", nullable=true)
     */
    private $descontoPontualidadeType;

    /**
     * @var string
     *
     * @ORM\Column(name="deconto_pontualidade_valor", type="decimal", precision=22, scale=2, nullable=false)
     */
    private $decontoPontualidadeValor = '0';

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="desconto_pontualidade_data", type="date", nullable=true)
     */
    private $descontoPontualidadeData;

    /**
     * @var string|null
     *
     * @ORM\Column(name="carteira", type="string", length=255, nullable=true)
     */
    private $carteira;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cod_convenio", type="string", length=255, nullable=true)
     */
    private $codConvenio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instrucao_linha1", type="string", length=45, nullable=true)
     */
    private $instrucaoLinha1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instrucao_linha2", type="string", length=45, nullable=true)
     */
    private $instrucaoLinha2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instrucao_linha3", type="string", length=45, nullable=true)
     */
    private $instrucaoLinha3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instrucao_linha4", type="string", length=45, nullable=true)
     */
    private $instrucaoLinha4;

    /**
     * @var string|null
     *
     * @ORM\Column(name="instrucao_linha5", type="string", length=45, nullable=true)
     */
    private $instrucaoLinha5;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observacoes", type="string", length=255, nullable=true)
     */
    private $observacoes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_documento", type="string", length=255, nullable=true)
     */
    private $emitenteDocumento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_name", type="string", length=255, nullable=true)
     */
    private $emitenteName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_endereco", type="string", length=255, nullable=true)
     */
    private $emitenteEndereco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_bairro", type="string", length=255, nullable=true)
     */
    private $emitenteBairro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_cep", type="string", length=255, nullable=true)
     */
    private $emitenteCep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_cidade", type="string", length=255, nullable=true)
     */
    private $emitenteCidade;

    /**
     * @var string|null
     *
     * @ORM\Column(name="emitente_uf", type="string", length=255, nullable=true)
     */
    private $emitenteUf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_documento", type="string", length=255, nullable=true)
     */
    private $sacadoDocumento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_name", type="string", length=255, nullable=true)
     */
    private $sacadoName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_endereco", type="string", length=255, nullable=true)
     */
    private $sacadoEndereco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_cep", type="string", length=255, nullable=true)
     */
    private $sacadoCep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_cidade", type="string", length=255, nullable=true)
     */
    private $sacadoCidade;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sacado_uf", type="string", length=255, nullable=true)
     */
    private $sacadoUf;


    /**
     * @var Bank
     *
     * @ORM\ManyToOne(targetEntity="Bank")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $bank;

    /**
     * @var FinanceBilling
     *
     * @ORM\ManyToOne(targetEntity="FinanceBilling")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeBilling;

    /**
     * @var FinanceBankAccount
     *
     * @ORM\ManyToOne(targetEntity="FinanceBankAccount")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $financeBankAccount;

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
     * @Groups({"read-finance_bank_billet"})
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSequence(): ?string
    {
        return $this->sequence;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getPaidAmount(): ?string
    {
        return $this->paidAmount;
    }

    /**
     * @return int
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDiscountType(): int
    {
        return $this->discountType;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDiscountValue(): string
    {
        return $this->discountValue;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDiscountPercentage(): string
    {
        return $this->discountPercentage;
    }

    /**
     * @return int
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDaysForDiscount(): int
    {
        return $this->daysForDiscount;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getMeta(): string
    {
        return $this->meta;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstructions(): string
    {
        return $this->instructions;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDocumentDate(): DateTime
    {
        return $this->documentDate;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getLine(): ?string
    {
        return $this->line;
    }

    /**
     * @return int|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getOurNumber(): ?int
    {
        return $this->ourNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getOurNumberWithDigit(): ?string
    {
        return $this->ourNumberWithDigit;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getOurNumberFormatted(): ?string
    {
        return $this->ourNumberFormatted;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInitialDueDate(): DateTime
    {
        return $this->initialDueDate;
    }

    /**
     * @return DateTime
     * @Groups({"read-finance_bank_billet"})
     */
    public function getPaidDate(): DateTime
    {
        return $this->paidDate;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getCodBanco(): string
    {
        return $this->codBanco;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getAgencia(): ?string
    {
        return $this->agencia;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getAgenciaDigito(): ?string
    {
        return $this->agenciaDigito;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getConta(): ?string
    {
        return $this->conta;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getContaDigito(): ?string
    {
        return $this->contaDigito;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getValor(): ?string
    {
        return $this->valor;
    }

    /**
     * @return int|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDescontoPontualidadeType(): ?int
    {
        return $this->descontoPontualidadeType;
    }

    /**
     * @return string
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDecontoPontualidadeValor(): string
    {
        return $this->decontoPontualidadeValor;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getDescontoPontualidadeData(): ?DateTime
    {
        return $this->descontoPontualidadeData;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getCarteira(): ?string
    {
        return $this->carteira;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getCodConvenio(): ?string
    {
        return $this->codConvenio;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstrucaoLinha1(): ?string
    {
        return $this->instrucaoLinha1;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstrucaoLinha2(): ?string
    {
        return $this->instrucaoLinha2;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstrucaoLinha3(): ?string
    {
        return $this->instrucaoLinha3;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstrucaoLinha4(): ?string
    {
        return $this->instrucaoLinha4;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getInstrucaoLinha5(): ?string
    {
        return $this->instrucaoLinha5;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteDocumento(): ?string
    {
        return $this->emitenteDocumento;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteName(): ?string
    {
        return $this->emitenteName;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteEndereco(): ?string
    {
        return $this->emitenteEndereco;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteBairro(): ?string
    {
        return $this->emitenteBairro;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteCep(): ?string
    {
        return $this->emitenteCep;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteCidade(): ?string
    {
        return $this->emitenteCidade;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getEmitenteUf(): ?string
    {
        return $this->emitenteUf;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoDocumento(): ?string
    {
        return $this->sacadoDocumento;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoName(): ?string
    {
        return $this->sacadoName;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoEndereco(): ?string
    {
        return $this->sacadoEndereco;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoCep(): ?string
    {
        return $this->sacadoCep;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoCidade(): ?string
    {
        return $this->sacadoCidade;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_bank_billet"})
     */
    public function getSacadoUf(): ?string
    {
        return $this->sacadoUf;
    }

    /**
     * @return Bank
     * @Groups({"read-finance_bank_billet-relations","read-finance_bank_billet-bank"})
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return FinanceBilling
     * @Groups({"read-finance_bank_billet-relations","read-finance_bank_billet-finance_billing"})
     */
    public function getFinanceBilling(): FinanceBilling
    {
        return $this->financeBilling;
    }

    /**
     * @return FinanceBankAccount
     * @Groups({"read-finance_bank_billet-relations","read-finance_bank_billet-finance_bank_account"})
     */
    public function getFinanceBankAccount(): FinanceBankAccount
    {
        return $this->financeBankAccount;
    }

    /**
     * @return CommonCancellationReason
     * @Groups({"read-finance_bank_billet-relations","read-finance_bank_billet-common_cancellation_reason"})
     */
    public function getCommonCancellationReason(): CommonCancellationReason
    {
        return $this->commonCancellationReason;
    }
    //endregion

    //region Setters
    /**
     * @param string $uuid
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setUuid(string $uuid): FinanceBankBillet
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @param string|null $sequence
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSequence(?string $sequence): FinanceBankBillet
    {
        $this->sequence = $sequence;
        return $this;
    }

    /**
     * @param string|null $amount
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setAmount(?string $amount): FinanceBankBillet
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $paidAmount
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setPaidAmount(?string $paidAmount): FinanceBankBillet
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }

    /**
     * @param int $discountType
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDiscountType(int $discountType): FinanceBankBillet
    {
        $this->discountType = $discountType;
        return $this;
    }

    /**
     * @param string $discountValue
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDiscountValue(string $discountValue): FinanceBankBillet
    {
        $this->discountValue = $discountValue;
        return $this;
    }

    /**
     * @param string $discountPercentage
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDiscountPercentage(string $discountPercentage): FinanceBankBillet
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * @param int $daysForDiscount
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDaysForDiscount(int $daysForDiscount): FinanceBankBillet
    {
        $this->daysForDiscount = $daysForDiscount;
        return $this;
    }

    /**
     * @param string $description
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDescription(string $description): FinanceBankBillet
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $meta
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setMeta(string $meta): FinanceBankBillet
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @param string $tags
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setTags(string $tags): FinanceBankBillet
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param string $instructions
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstructions(string $instructions): FinanceBankBillet
    {
        $this->instructions = $instructions;
        return $this;
    }

    /**
     * @param string $documentType
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDocumentType(string $documentType): FinanceBankBillet
    {
        $this->documentType = $documentType;
        return $this;
    }

    /**
     * @param DateTime $documentDate
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDocumentDate(DateTime $documentDate): FinanceBankBillet
    {
        $this->documentDate = $documentDate;
        return $this;
    }

    /**
     * @param string $documentNumber
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDocumentNumber(string $documentNumber): FinanceBankBillet
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    /**
     * @param string|null $line
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setLine(?string $line): FinanceBankBillet
    {
        $this->line = $line;
        return $this;
    }

    /**
     * @param int|null $ourNumber
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setOurNumber(?int $ourNumber): FinanceBankBillet
    {
        $this->ourNumber = $ourNumber;
        return $this;
    }

    /**
     * @param string|null $ourNumberWithDigit
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setOurNumberWithDigit(?string $ourNumberWithDigit): FinanceBankBillet
    {
        $this->ourNumberWithDigit = $ourNumberWithDigit;
        return $this;
    }

    /**
     * @param string|null $ourNumberFormatted
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setOurNumberFormatted(?string $ourNumberFormatted): FinanceBankBillet
    {
        $this->ourNumberFormatted = $ourNumberFormatted;
        return $this;
    }

    /**
     * @param DateTime $dueDate
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDueDate(DateTime $dueDate): FinanceBankBillet
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param DateTime $initialDueDate
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInitialDueDate(DateTime $initialDueDate): FinanceBankBillet
    {
        $this->initialDueDate = $initialDueDate;
        return $this;
    }

    /**
     * @param DateTime $paidDate
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setPaidDate(DateTime $paidDate): FinanceBankBillet
    {
        $this->paidDate = $paidDate;
        return $this;
    }

    /**
     * @param string $codBanco
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setCodBanco(string $codBanco): FinanceBankBillet
    {
        $this->codBanco = $codBanco;
        return $this;
    }

    /**
     * @param string|null $agencia
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setAgencia(?string $agencia): FinanceBankBillet
    {
        $this->agencia = $agencia;
        return $this;
    }

    /**
     * @param string|null $agenciaDigito
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setAgenciaDigito(?string $agenciaDigito): FinanceBankBillet
    {
        $this->agenciaDigito = $agenciaDigito;
        return $this;
    }

    /**
     * @param string|null $conta
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setConta(?string $conta): FinanceBankBillet
    {
        $this->conta = $conta;
        return $this;
    }

    /**
     * @param string|null $contaDigito
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setContaDigito(?string $contaDigito): FinanceBankBillet
    {
        $this->contaDigito = $contaDigito;
        return $this;
    }

    /**
     * @param string|null $valor
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setValor(?string $valor): FinanceBankBillet
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @param int|null $descontoPontualidadeType
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDescontoPontualidadeType(?int $descontoPontualidadeType): FinanceBankBillet
    {
        $this->descontoPontualidadeType = $descontoPontualidadeType;
        return $this;
    }

    /**
     * @param string $decontoPontualidadeValor
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDecontoPontualidadeValor(string $decontoPontualidadeValor): FinanceBankBillet
    {
        $this->decontoPontualidadeValor = $decontoPontualidadeValor;
        return $this;
    }

    /**
     * @param DateTime|null $descontoPontualidadeData
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setDescontoPontualidadeData(?DateTime $descontoPontualidadeData): FinanceBankBillet
    {
        $this->descontoPontualidadeData = $descontoPontualidadeData;
        return $this;
    }

    /**
     * @param string|null $carteira
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setCarteira(?string $carteira): FinanceBankBillet
    {
        $this->carteira = $carteira;
        return $this;
    }

    /**
     * @param string|null $codConvenio
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setCodConvenio(?string $codConvenio): FinanceBankBillet
    {
        $this->codConvenio = $codConvenio;
        return $this;
    }

    /**
     * @param string|null $instrucaoLinha1
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstrucaoLinha1(?string $instrucaoLinha1): FinanceBankBillet
    {
        $this->instrucaoLinha1 = $instrucaoLinha1;
        return $this;
    }

    /**
     * @param string|null $instrucaoLinha2
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstrucaoLinha2(?string $instrucaoLinha2): FinanceBankBillet
    {
        $this->instrucaoLinha2 = $instrucaoLinha2;
        return $this;
    }

    /**
     * @param string|null $instrucaoLinha3
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstrucaoLinha3(?string $instrucaoLinha3): FinanceBankBillet
    {
        $this->instrucaoLinha3 = $instrucaoLinha3;
        return $this;
    }

    /**
     * @param string|null $instrucaoLinha4
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstrucaoLinha4(?string $instrucaoLinha4): FinanceBankBillet
    {
        $this->instrucaoLinha4 = $instrucaoLinha4;
        return $this;
    }

    /**
     * @param string|null $instrucaoLinha5
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setInstrucaoLinha5(?string $instrucaoLinha5): FinanceBankBillet
    {
        $this->instrucaoLinha5 = $instrucaoLinha5;
        return $this;
    }

    /**
     * @param string|null $observacoes
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setObservacoes(?string $observacoes): FinanceBankBillet
    {
        $this->observacoes = $observacoes;
        return $this;
    }

    /**
     * @param string|null $emitenteDocumento
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteDocumento(?string $emitenteDocumento): FinanceBankBillet
    {
        $this->emitenteDocumento = $emitenteDocumento;
        return $this;
    }

    /**
     * @param string|null $emitenteName
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteName(?string $emitenteName): FinanceBankBillet
    {
        $this->emitenteName = $emitenteName;
        return $this;
    }

    /**
     * @param string|null $emitenteEndereco
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteEndereco(?string $emitenteEndereco): FinanceBankBillet
    {
        $this->emitenteEndereco = $emitenteEndereco;
        return $this;
    }

    /**
     * @param string|null $emitenteBairro
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteBairro(?string $emitenteBairro): FinanceBankBillet
    {
        $this->emitenteBairro = $emitenteBairro;
        return $this;
    }

    /**
     * @param string|null $emitenteCep
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteCep(?string $emitenteCep): FinanceBankBillet
    {
        $this->emitenteCep = $emitenteCep;
        return $this;
    }

    /**
     * @param string|null $emitenteCidade
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteCidade(?string $emitenteCidade): FinanceBankBillet
    {
        $this->emitenteCidade = $emitenteCidade;
        return $this;
    }

    /**
     * @param string|null $emitenteUf
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setEmitenteUf(?string $emitenteUf): FinanceBankBillet
    {
        $this->emitenteUf = $emitenteUf;
        return $this;
    }

    /**
     * @param string|null $sacadoDocumento
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoDocumento(?string $sacadoDocumento): FinanceBankBillet
    {
        $this->sacadoDocumento = $sacadoDocumento;
        return $this;
    }

    /**
     * @param string|null $sacadoName
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoName(?string $sacadoName): FinanceBankBillet
    {
        $this->sacadoName = $sacadoName;
        return $this;
    }

    /**
     * @param string|null $sacadoEndereco
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoEndereco(?string $sacadoEndereco): FinanceBankBillet
    {
        $this->sacadoEndereco = $sacadoEndereco;
        return $this;
    }

    /**
     * @param string|null $sacadoCep
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoCep(?string $sacadoCep): FinanceBankBillet
    {
        $this->sacadoCep = $sacadoCep;
        return $this;
    }

    /**
     * @param string|null $sacadoCidade
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoCidade(?string $sacadoCidade): FinanceBankBillet
    {
        $this->sacadoCidade = $sacadoCidade;
        return $this;
    }

    /**
     * @param string|null $sacadoUf
     * @return FinanceBankBillet
     * @Groups({"write-finance_bank_billet"})
     */
    public function setSacadoUf(?string $sacadoUf): FinanceBankBillet
    {
        $this->sacadoUf = $sacadoUf;
        return $this;
    }

    /**
     * @param Bank $bank
     * @return FinanceBankBillet
     */
    public function setBank(Bank $bank): FinanceBankBillet
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @param FinanceBilling $financeBilling
     * @return FinanceBankBillet
     */
    public function setFinanceBilling(FinanceBilling $financeBilling): FinanceBankBillet
    {
        $this->financeBilling = $financeBilling;
        return $this;
    }

    /**
     * @param FinanceBankAccount $financeBankAccount
     * @return FinanceBankBillet
     */
    public function setFinanceBankAccount(FinanceBankAccount $financeBankAccount): FinanceBankBillet
    {
        $this->financeBankAccount = $financeBankAccount;
        return $this;
    }

    /**
     * @param CommonCancellationReason $commonCancellationReason
     * @return FinanceBankBillet
     */
    public function setCommonCancellationReason(CommonCancellationReason $commonCancellationReason): FinanceBankBillet
    {
        $this->commonCancellationReason = $commonCancellationReason;
        return $this;
    }
    //endregion
}
