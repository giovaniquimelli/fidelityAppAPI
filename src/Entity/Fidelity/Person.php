<?php

namespace App\Entity\Fidelity;


use App\Doctrine\Types\Date;
use App\Entity\Fidelity\Base\BasePerson;
use App\Exception\ItemNotFoundException;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Person
 *
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Person extends BasePerson
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="person_type", type="string", length=1, nullable=false, options={"default"="F","fixed"=true})
     */
    private string $personType = 'F';

    /**
     * @var string|null
     *
     * @ORM\Column(name="person_code", type="string", length=255, nullable=true)
     */
    private ?string $personCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
     */
    private ?string $fullName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="legal_name", type="string", length=255, nullable=true)
     */
    private ?string $legalName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ric_code", type="string", length=255, nullable=true, options={"comment"="Novo documento de identificação"})
     */
    private ?string $ricCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="cpf_cnpj", type="string", length=255, nullable=false, unique=true)
     */
    private string $cpfCnpj;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rg_ie_code", type="string", length=255, nullable=true)
     */
    private ?string $rgIeCode = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="rg_orgao", type="string", length=255, nullable=true)
     */
    private ?string $rgOrgao = '';

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="rg_date", type="date", nullable=true)
     */
    private ?DateTime $rgDate;


    /**
     * @var bool
     *
     * @ORM\Column(name="is_foreign", type="boolean", nullable=true, options={"default":"false"})
     */
    private bool $isForeign = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foreign_social_id", type="string", length=255, nullable=true)
     */
    private ?string $foreignSocialId = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="foreign_passport_number", type="string", length=255, nullable=true)
     */
    private ?string $foreignPassportNumber = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="details", type="text", nullable=true)
     */
    private ?string $details = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile_phone", type="string", length=255, nullable=true)
     */
    private ?string $mobilePhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private ?string $phone = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_notification", type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $enableNotification = true;

    /**
     * @var Person|null
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?Person $person = null;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?CompanyBranch $companyBranch = null;

    /**
     * @var CountryState|null
     *
     * @ORM\ManyToOne(targetEntity="CountryState")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?CountryState $stateRgIe = null;

    /**
     * @var Date|null
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private ?Date $birthDate = null;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=false, options={"default"="M","fixed"=true})
     */
    private string $gender = 'M';

    /**
     * @var string|null
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=true)
     */
    private ?string $occupation = '';

    /**
     * @var int
     *
     * @ORM\Column(name="marital_status", type="integer", nullable=false, options={"default":"0","comment"="ENUM('NÃO INFORMADO', 'SOLTEIRO(A)', 'CASADO(A)', 'DIVORCIADO(A)', 'VIÚVO(A)', 'SEPARADO(A)', 'UNIÃO ESTÁVEL')"})
     */
    private int $maritalStatus = 0;

    //endregion

    //region Getters
    /**
     * @return string
     * @Groups({"read-person-min","read-person"})
     */
    public function getPersonType(): string
    {
        return $this->personType;
    }

    /**
     * @return string|null
     * @Groups({"read-person-min","read-person"})
     */
    public function getPersonCode(): ?string
    {
        return $this->personCode;
    }

    /**
     * @return string
     * @Groups({"read-person-min","read-person"})
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getRicCode(): ?string
    {
        return $this->ricCode;
    }

    /**
     * @return string
     * @Groups({"read-person-min","read-person"})
     */
    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getRgIeCode(): ?string
    {
        return $this->rgIeCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getRgOrgao(): ?string
    {
        return $this->rgOrgao;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-person"})
     */
    public function getRgDate(): ?DateTime
    {
        return $this->rgDate;
    }

    /**
     * @return bool
     * @Groups({"read-person-min","read-person"})
     */
    public function isForeign(): bool
    {
        return $this->isForeign;
    }

    /**
     * @return string|null
     * @Groups({"read-person-min","read-person"})
     */
    public function getForeignSocialId(): ?string
    {
        return $this->foreignSocialId;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getForeignPassportNumber(): ?string
    {
        return $this->foreignPassportNumber;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getDetails(): ?string
    {
        return $this->details;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return bool
     * @Groups({"read-person"})
     */
    public function isEnableNotification(): bool
    {
        return $this->enableNotification;
    }

    /**
     * @return Person|null
     * @Groups({"read-person-relations","read-person-person"})
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-person-relations","read-person-company-branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return CountryState|null
     * @Groups({"read-person-relations","read-person-coutry_state"})
     */
    public function getStateRgIe(): ?CountryState
    {
        return $this->stateRgIe;
    }

    /**
     * @return Date|null
     * @Groups({"read-person"})
     */
    public function getBirthDate(): ?Date
    {
        return $this->birthDate;
    }

    /**
     * @return string
     * @Groups({"read-person"})
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string|null
     * @Groups({"read-person"})
     */
    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    /**
     * @return int
     * @Groups({"read-person"})
     */
    public function getMaritalStatus(): int
    {
        return $this->maritalStatus;
    }
    //endregion

    //region Setters
    /**
     * @param string $personType
     * @return Person
     * @Groups({"write-person"})
     */
    public function setPersonType(string $personType): Person
    {
        $this->personType = $personType;
        return $this;
    }

    /**
     * @param string|null $personCode
     * @return Person
     * @Groups({"write-person"})
     */
    public function setPersonCode(?string $personCode): Person
    {
        $this->personCode = $personCode;
        return $this;
    }

    /**
     * @param string $fullName
     * @return Person
     * @Groups({"write-person"})
     */
    public function setFullName(string $fullName): Person
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @param string|null $legalName
     * @return Person
     * @Groups({"write-person"})
     */
    public function setLegalName(?string $legalName): Person
    {
        $this->legalName = $legalName;
        return $this;
    }

    /**
     * @param string|null $ricCode
     * @return Person
     * @Groups({"write-person"})
     */
    public function setRicCode(?string $ricCode): Person
    {
        $this->ricCode = $ricCode;
        return $this;
    }

    /**
     * @param string $cpfCnpj
     * @return Person
     * @Groups({"write-person"})
     */
    public function setCpfCnpj(string $cpfCnpj): Person
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    /**
     * @param string|null $rgIeCode
     * @return Person
     * @Groups({"write-person"})
     */
    public function setRgIeCode(?string $rgIeCode): Person
    {
        $this->rgIeCode = $rgIeCode;
        return $this;
    }

    /**
     * @param string|null $rgOrgao
     * @return Person
     * @Groups({"write-person"})
     */
    public function setRgOrgao(?string $rgOrgao): Person
    {
        $this->rgOrgao = $rgOrgao;
        return $this;
    }

    /**
     * @param DateTime|null $rgDate
     * @return Person
     * @Groups({"write-person"})
     */
    public function setRgDate(?DateTime $rgDate): Person
    {
        $this->rgDate = $rgDate;
        return $this;
    }

    /**
     * @param bool $isForeign
     * @return Person
     * @Groups({"write-person"})
     */
    public function setIsForeign(bool $isForeign): Person
    {
        $this->isForeign = $isForeign;
        return $this;
    }

    /**
     * @param string|null $foreignSocialId
     * @return Person
     * @Groups({"write-person"})
     */
    public function setForeignSocialId(?string $foreignSocialId): Person
    {
        $this->foreignSocialId = $foreignSocialId;
        return $this;
    }

    /**
     * @param string|null $foreignPassportNumber
     * @return Person
     * @Groups({"write-person"})
     */
    public function setForeignPassportNumber(?string $foreignPassportNumber): Person
    {
        $this->foreignPassportNumber = $foreignPassportNumber;
        return $this;
    }

    /**
     * @param string|null $details
     * @return Person
     * @Groups({"write-person"})
     */
    public function setDetails(?string $details): Person
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @param string|null $email
     * @return Person
     * @Groups({"write-person"})
     */
    public function setEmail(?string $email): Person
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null $mobilePhone
     * @return Person
     * @Groups({"write-person"})
     */
    public function setMobilePhone(?string $mobilePhone): Person
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @param string|null $phone
     * @return Person
     * @Groups({"write-person"})
     */
    public function setPhone(?string $phone): Person
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param bool $enableNotification
     * @return Person
     * @Groups({"write-person"})
     */
    public function setEnableNotification(bool $enableNotification): Person
    {
        $this->enableNotification = $enableNotification;
        return $this;
    }

    /**
     * @param Person|null $person
     * @return Person
     */
    public function setPerson(?Person $person): Person
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return Person
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): Person
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param CountryState|null $stateRgIe
     * @return Person
     */
    public function setStateRgIe(?CountryState $stateRgIe): Person
    {
        $this->stateRgIe = $stateRgIe;
        return $this;
    }

    /**
     * @param Date|null $birthDate
     * @return Person
     * @Groups({"write-person"})
     */
    public function setBirthDate(?Date $birthDate): Person
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @param string $gender
     * @return Person
     * @Groups({"write-person"})
     */
    public function setGender(string $gender): Person
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param string|null $occupation
     * @return Person
     * @Groups({"write-person"})
     */
    public function setOccupation(?string $occupation): Person
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @param int $maritalStatus
     * @return Person
     * @Groups({"write-person"})
     */
    public function setMaritalStatus(int $maritalStatus): Person
    {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }
    //endregion

}
