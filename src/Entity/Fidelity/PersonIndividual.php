<?php

namespace App\Entity\Fidelity;

use App\Doctrine\Types\Date;

use App\Entity\Fidelity\Base\BasePersonIndividual;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonIndividual
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonIndividual extends BasePersonIndividual
{
    //region Columns
    /**
     * @var Date
     *
     * @ORM\Column(name="birth_date", type="date", nullable=false)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=false, options={"default"="M","fixed"=true})
     */
    private $gender = 'M';

    /**
     * @var string|null
     *
     * @ORM\Column(name="father_name", type="string", length=255, nullable=true)
     */
    private $fatherName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mother_name", type="string", length=255, nullable=true)
     */
    private $motherName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_certificate_code", type="string", length=255, nullable=true)
     */
    private $birthCertificateCode = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_certificate_book", type="string", length=255, nullable=true)
     */
    private $birthCertificateBook = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_certificate_sheet_code", type="string", length=255, nullable=true)
     */
    private $birthCertificateSheetCode = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birth_certificate_registry_office", type="string", length=255, nullable=true)
     */
    private $birthCertificateRegistryOffice = '';

    /**
     * @var Date|null
     *
     * @ORM\Column(name="birth_certificate_date", type="date", nullable=true)
     */
    private $birthCertificateDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="election_card_code", type="string", length=255, nullable=true)
     */
    private $electionCardCode = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="election_card_zone", type="string", length=255, nullable=true)
     */
    private $electionCardZone = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="election_card_section", type="string", length=255, nullable=true)
     */
    private $electionCardSection = '';

    /**
     * @var Date|null
     *
     * @ORM\Column(name="election_card_date", type="date", nullable=true)
     */
    private $electionCardDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=true)
     */
    private $occupation = '';

    /**
     * @var int
     *
     * @ORM\Column(name="marital_status", type="integer", nullable=false, options={"comment"="ENUM('NÃO INFORMADO', 'SOLTEIRO(A)', 'CASADO(A)', 'DIVORCIADO(A)', 'VIÚVO(A)', 'SEPARADO(A)', 'UNIÃO ESTÁVEL')"})
     */
    private $maritalStatus = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="spouse_name", type="string", length=255, nullable=true)
     */
    private $spouseName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nationality", type="string", length=255, nullable=true)
     */
    private $nationality = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="nationality_country", type="string", length=255, nullable=true)
     */
    private $nationalityCountry = '';

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="Person", inversedBy="personIndividual")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false, unique=true)
     */
    private $person;

    /**
     * @var CountryState|null
     *
     * @ORM\ManyToOne(targetEntity="CountryState")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private $birthCertificateState;

    /**
     * @var City|null
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private $birthCity;
    //endregion

    //region Getters
    /**
     * @return Date
     * @Groups({"read-person_individual-min","read-person_individual"})
     */
    public function getBirthDate(): Date
    {
        return $this->birthDate;
    }

    /**
     * @return string
     * @Groups({"read-person_individual-min","read-person_individual"})
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getFatherName(): ?string
    {
        return $this->fatherName;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getMotherName(): ?string
    {
        return $this->motherName;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getBirthCertificateCode(): ?string
    {
        return $this->birthCertificateCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getBirthCertificateBook(): ?string
    {
        return $this->birthCertificateBook;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getBirthCertificateSheetCode(): ?string
    {
        return $this->birthCertificateSheetCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getBirthCertificateRegistryOffice(): ?string
    {
        return $this->birthCertificateRegistryOffice;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-person_individual"})
     */
    public function getBirthCertificateDate(): ?DateTime
    {
        return $this->birthCertificateDate;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getElectionCardCode(): ?string
    {
        return $this->electionCardCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getElectionCardZone(): ?string
    {
        return $this->electionCardZone;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getElectionCardSection(): ?string
    {
        return $this->electionCardSection;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-person_individual"})
     */
    public function getElectionCardDate(): ?DateTime
    {
        return $this->electionCardDate;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    /**
     * @return int
     * @Groups({"read-person_individual"})
     */
    public function getMaritalStatus(): int
    {
        return $this->maritalStatus;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getSpouseName(): ?string
    {
        return $this->spouseName;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @return string|null
     * @Groups({"read-person_individual"})
     */
    public function getNationalityCountry(): ?string
    {
        return $this->nationalityCountry;
    }


    /**
     * @return Person
     * @Groups({"read-person_individual-relations","read-person_individual-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return CountryState|null
     * @Groups({"read-person_individual-relations","read-person_individual-country_state"})
     */
    public function getBirthCertificateState(): ?CountryState
    {
        return $this->birthCertificateState;
    }

    /**
     * @return City|null
     * @Groups({"read-person_individual-relations","read-person_individual-city"})
     */
    public function getBirthCity(): ?City
    {
        return $this->birthCity;
    }
    //endregion

    //region Setters
    /**
     * @param Date $birthDate
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthDate($birthDate): PersonIndividual
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @param string $gender
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setGender(string $gender): PersonIndividual
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param string|null $fatherName
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setFatherName(?string $fatherName): PersonIndividual
    {
        $this->fatherName = $fatherName;
        return $this;
    }

    /**
     * @param string|null $motherName
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setMotherName(?string $motherName): PersonIndividual
    {
        $this->motherName = $motherName;
        return $this;
    }

    /**
     * @param string|null $birthCertificateCode
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthCertificateCode(?string $birthCertificateCode): PersonIndividual
    {
        $this->birthCertificateCode = $birthCertificateCode;
        return $this;
    }

    /**
     * @param string|null $birthCertificateBook
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthCertificateBook(?string $birthCertificateBook): PersonIndividual
    {
        $this->birthCertificateBook = $birthCertificateBook;
        return $this;
    }

    /**
     * @param string|null $birthCertificateSheetCode
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthCertificateSheetCode(?string $birthCertificateSheetCode): PersonIndividual
    {
        $this->birthCertificateSheetCode = $birthCertificateSheetCode;
        return $this;
    }

    /**
     * @param string|null $birthCertificateRegistryOffice
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthCertificateRegistryOffice(?string $birthCertificateRegistryOffice): PersonIndividual
    {
        $this->birthCertificateRegistryOffice = $birthCertificateRegistryOffice;
        return $this;
    }

    /**
     * @param DateTime|null $birthCertificateDate
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setBirthCertificateDate(?DateTime $birthCertificateDate): PersonIndividual
    {
        $this->birthCertificateDate = $birthCertificateDate;
        return $this;
    }

    /**
     * @param string|null $electionCardCode
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setElectionCardCode(?string $electionCardCode): PersonIndividual
    {
        $this->electionCardCode = $electionCardCode;
        return $this;
    }

    /**
     * @param string|null $electionCardZone
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setElectionCardZone(?string $electionCardZone): PersonIndividual
    {
        $this->electionCardZone = $electionCardZone;
        return $this;
    }

    /**
     * @param string|null $electionCardSection
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setElectionCardSection(?string $electionCardSection): PersonIndividual
    {
        $this->electionCardSection = $electionCardSection;
        return $this;
    }

    /**
     * @param DateTime|null $electionCardDate
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setElectionCardDate(?DateTime $electionCardDate): PersonIndividual
    {
        $this->electionCardDate = $electionCardDate;
        return $this;
    }

    /**
     * @param string|null $occupation
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setOccupation(?string $occupation): PersonIndividual
    {
        $this->occupation = $occupation;
        return $this;
    }

    /**
     * @param int $maritalStatus
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setMaritalStatus(int $maritalStatus): PersonIndividual
    {
        $this->maritalStatus = $maritalStatus;
        return $this;
    }

    /**
     * @param string|null $spouseName
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setSpouseName(?string $spouseName): PersonIndividual
    {
        $this->spouseName = $spouseName;
        return $this;
    }

    /**
     * @param string|null $nationality
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setNationality(?string $nationality): PersonIndividual
    {
        $this->nationality = $nationality;
        return $this;
    }

    /**
     * @param string|null $nationalityCountry
     * @return PersonIndividual
     * @Groups({"write-person_individual"})
     */
    public function setNationalityCountry(?string $nationalityCountry): PersonIndividual
    {
        $this->nationalityCountry = $nationalityCountry;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonIndividual
     */
    public function setPerson(Person $person): PersonIndividual
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param CountryState|null $birthCertificateState
     * @return PersonIndividual
     */
    public function setBirthCertificateState(?CountryState $birthCertificateState): PersonIndividual
    {
        $this->birthCertificateState = $birthCertificateState;
        return $this;
    }

    /**
     * @param City|null $birthCity
     * @return PersonIndividual
     */
    public function setBirthCity(?City $birthCity): PersonIndividual
    {
        $this->birthCity = $birthCity;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
