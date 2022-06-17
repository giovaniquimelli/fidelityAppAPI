<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceCheck;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceCheck
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceCheck extends BaseFinanceCheck
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="cmc7", type="string", length=45, nullable=true)
     */
    private $cmc7;

    /**
     * @var string|null
     *
     * @ORM\Column(name="data_emissao", type="string", length=255, nullable=true)
     */
    private $dataEmissao;

    /**
     * @var string|null
     *
     * @ORM\Column(name="due_date", type="string", length=255, nullable=true)
     */
    private $dueDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="process_date", type="string", length=255, nullable=true)
     */
    private $processDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount", type="string", length=255, nullable=true)
     */
    private $amount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nominal", type="string", length=255, nullable=true)
     */
    private $nominal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmc7_agencia", type="string", length=45, nullable=true)
     */
    private $cmc7Agencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmc7_conta", type="string", length=45, nullable=true)
     */
    private $cmc7Conta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmc7_comp", type="string", length=45, nullable=true)
     */
    private $cmc7Comp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cmc7_num_cheque", type="string", length=45, nullable=true)
     */
    private $cmc7NumCheque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagem", type="text", nullable=true)
     */
    private $imagem;


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
     * @var Bank
     *
     * @ORM\ManyToOne(targetEntity="Bank")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $bankCmc7;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getCmc7(): ?string
    {
        return $this->cmc7;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getDataEmissao(): ?string
    {
        return $this->dataEmissao;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getProcessDate(): ?string
    {
        return $this->processDate;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getNominal(): ?string
    {
        return $this->nominal;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getCmc7Agencia(): ?string
    {
        return $this->cmc7Agencia;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getCmc7Conta(): ?string
    {
        return $this->cmc7Conta;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getCmc7Comp(): ?string
    {
        return $this->cmc7Comp;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getCmc7NumCheque(): ?string
    {
        return $this->cmc7NumCheque;
    }

    /**
     * @return string|null
     * @Groups({"read-finance_check"})
     */
    public function getImagem(): ?string
    {
        return $this->imagem;
    }

    /**
     * @return Bank
     * @Groups({"read-finance_check-relations","read-finance_check-bank"})
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return FinanceBilling
     * @Groups({"read-finance_check-relations","read-finance_check-finance_billing"})
     */
    public function getFinanceBilling(): FinanceBilling
    {
        return $this->financeBilling;
    }

    /**
     * @return Bank
     * @Groups({"read-finance_check-relations","read-finance_check-bank"})
     */
    public function getBankCmc7(): Bank
    {
        return $this->bankCmc7;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $cmc7
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setCmc7(?string $cmc7): FinanceCheck
    {
        $this->cmc7 = $cmc7;
        return $this;
    }

    /**
     * @param string|null $dataEmissao
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setDataEmissao(?string $dataEmissao): FinanceCheck
    {
        $this->dataEmissao = $dataEmissao;
        return $this;
    }

    /**
     * @param string|null $dueDate
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setDueDate(?string $dueDate): FinanceCheck
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param string|null $processDate
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setProcessDate(?string $processDate): FinanceCheck
    {
        $this->processDate = $processDate;
        return $this;
    }

    /**
     * @param string|null $type
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setType(?string $type): FinanceCheck
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string|null $amount
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setAmount(?string $amount): FinanceCheck
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string|null $nominal
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setNominal(?string $nominal): FinanceCheck
    {
        $this->nominal = $nominal;
        return $this;
    }

    /**
     * @param string|null $cmc7Agencia
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setCmc7Agencia(?string $cmc7Agencia): FinanceCheck
    {
        $this->cmc7Agencia = $cmc7Agencia;
        return $this;
    }

    /**
     * @param string|null $cmc7Conta
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setCmc7Conta(?string $cmc7Conta): FinanceCheck
    {
        $this->cmc7Conta = $cmc7Conta;
        return $this;
    }

    /**
     * @param string|null $cmc7Comp
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setCmc7Comp(?string $cmc7Comp): FinanceCheck
    {
        $this->cmc7Comp = $cmc7Comp;
        return $this;
    }

    /**
     * @param string|null $cmc7NumCheque
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setCmc7NumCheque(?string $cmc7NumCheque): FinanceCheck
    {
        $this->cmc7NumCheque = $cmc7NumCheque;
        return $this;
    }

    /**
     * @param string|null $imagem
     * @return FinanceCheck
     * @Groups({"write-finance_check"})
     */
    public function setImagem(?string $imagem): FinanceCheck
    {
        $this->imagem = $imagem;
        return $this;
    }

    /**
     * @param Bank $bank
     * @return FinanceCheck
     */
    public function setBank(Bank $bank): FinanceCheck
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @param FinanceBilling $financeBilling
     * @return FinanceCheck
     */
    public function setFinanceBilling(FinanceBilling $financeBilling): FinanceCheck
    {
        $this->financeBilling = $financeBilling;
        return $this;
    }

    /**
     * @param Bank $bankCmc7
     * @return FinanceCheck
     */
    public function setBankCmc7(Bank $bankCmc7): FinanceCheck
    {
        $this->bankCmc7 = $bankCmc7;
        return $this;
    }
    //endregion
}
