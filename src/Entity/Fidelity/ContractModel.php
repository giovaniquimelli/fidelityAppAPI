<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseContractModel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ContractModel
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ContractModel extends BaseContractModel
{/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="header_template", type="text", nullable=true)
     */
    private $headerTemplate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="clauses_template", type="text", nullable=true)
     */
    private $clausesTemplate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="payment_template", type="text", nullable=true)
     */
    private $paymentTemplate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="course_template", type="text", nullable=true)
     */
    private $courseTemplate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="class_template", type="text", nullable=true)
     */
    private $classTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="text", nullable=false)
     */
    private $template;

    /**
     * @var ContractType
     *
     * @ORM\ManyToOne(targetEntity="ContractType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $contractType;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;

    //region Getters
    /**
     * @return string
     * @Groups({"read-contract_model-min","read-contract_model"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-contract_model"})
     */
    public function getHeaderTemplate(): ?string
    {
        return $this->headerTemplate;
    }

    /**
     * @return string|null
     * @Groups({"read-contract_model"})
     */
    public function getClausesTemplate(): ?string
    {
        return $this->clausesTemplate;
    }

    /**
     * @return string|null
     * @Groups({"read-contract_model"})
     */
    public function getPaymentTemplate(): ?string
    {
        return $this->paymentTemplate;
    }

    /**
     * @return string|null
     * @Groups({"read-contract_model"})
     */
    public function getCourseTemplate(): ?string
    {
        return $this->courseTemplate;
    }

    /**
     * @return string|null
     * @Groups({"read-contract_model"})
     */
    public function getClassTemplate(): ?string
    {
        return $this->classTemplate;
    }

    /**
     * @return string
     * @Groups({"read-contract_model"})
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return ContractType
     * @Groups({"read-contract_model-relations","read-contract_model-contract_type"})
     */
    public function getContractType(): ContractType
    {
        return $this->contractType;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-contract_model-relations","read-contract_model-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters

    /**
     * @param string $name
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setName(string $name): ContractModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $headerTemplate
     * @return ContractModel
     */
    public function setHeaderTemplate(?string $headerTemplate): ContractModel
    {
        $this->headerTemplate = $headerTemplate;
        return $this;
    }

    /**
     * @param string|null $clausesTemplate
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setClausesTemplate(?string $clausesTemplate): ContractModel
    {
        $this->clausesTemplate = $clausesTemplate;
        return $this;
    }

    /**
     * @param string|null $paymentTemplate
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setPaymentTemplate(?string $paymentTemplate): ContractModel
    {
        $this->paymentTemplate = $paymentTemplate;
        return $this;
    }

    /**
     * @param string|null $courseTemplate
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setCourseTemplate(?string $courseTemplate): ContractModel
    {
        $this->courseTemplate = $courseTemplate;
        return $this;
    }

    /**
     * @param string|null $classTemplate
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setClassTemplate(?string $classTemplate): ContractModel
    {
        $this->classTemplate = $classTemplate;
        return $this;
    }

    /**
     * @param string $template
     * @return ContractModel
     * @Groups({"write-contract_model"})
     */
    public function setTemplate(string $template): ContractModel
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @param ContractType $contractType
     * @return ContractModel
     */
    public function setContractType(ContractType $contractType): ContractModel
    {
        $this->contractType = $contractType;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return ContractModel
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): ContractModel
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
