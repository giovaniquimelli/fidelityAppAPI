<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranch
 *
 * @ORM\Entity(repositoryClass="App\Repository\CompanyBranchRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranch extends BaseCompanyBranch
{
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?Person $person = null;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Serializer\Groups({"read", "read-companybranch"})
     */
    private string $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="legal_name", type="string", length=255, nullable=true)
     */
    private string $legalName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="cpf_cnpj", type="string", length=14, nullable=true)
     */
    private string $cpfCnpj = '';

    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private string $address;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private int $number;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=255, nullable=false)
     */
    private string $district;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private ?string $complement;

    /**
     * @var int
     *
     * @ORM\Column(name="zip_code", type="integer", nullable=false)
     */
    private int $zipCode;


    /**
     * @var string|null
     *
     * @ORM\Column(name="post_box", type="string", length=255, nullable=true)
     */
    private ?string $postBox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="decimal", precision=28, scale=8, nullable=true)
     */
    private ?string $latitude = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="decimal", precision=28, scale=8, nullable=true)
     */
    private ?string $longitude = '0';


    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private City $city;

    //endregion

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private bool $active;

    public function __construct()
    {
        $this->person = new Person();
    }

    //region Getters

    /**
     * @return Person|null
     * @Groups({"read-company_branch-relations","read-company_branch-person"})
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @return string
     * @Groups({"read-company_branch-min","read-company_branch"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-company_branch"})
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return CompanyBranch
     */
    public function setAddress(string $address): CompanyBranch
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-company_branch"})
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return CompanyBranch
     */
    public function setNumber(int $number): CompanyBranch
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch"})
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return CompanyBranch
     */
    public function setDistrict(string $district): CompanyBranch
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch"})
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @param string|null $complement
     * @return CompanyBranch
     */
    public function setComplement(?string $complement): CompanyBranch
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-company_branch"})
     */
    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     * @return CompanyBranch
     */
    public function setZipCode(int $zipCode): CompanyBranch
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch"})
     */
    public function getPostBox(): ?string
    {
        return $this->postBox;
    }

    /**
     * @param string|null $postBox
     * @return CompanyBranch
     */
    public function setPostBox(?string $postBox): CompanyBranch
    {
        $this->postBox = $postBox;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch"})
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return CompanyBranch
     */
    public function setLatitude(?string $latitude): CompanyBranch
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch"})
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return CompanyBranch
     */
    public function setLongitude(?string $longitude): CompanyBranch
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return City
     * @Groups({"read-company_branch-relations","read-company_branch-city"})
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return CompanyBranch
     */
    public function setCity(City $city): CompanyBranch
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch-min","read-company_branch"})
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @return string|null
     * @Groups({"read-company_branch"})
     */
    public function getCpfCnpj(): ?string
    {
        return $this->cpfCnpj;
    }

    /**
     * @return bool
     * @Groups({"read-company_branch"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    //endregion

    //region Setters
    /**
     * @param Person $person
     * @return CompanyBranch
     */
    public function setPerson(Person $person): CompanyBranch
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param string $name
     * @return CompanyBranch
     * @Groups({"write-company_branch"})
     */
    public function setName(string $name): CompanyBranch
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $legalName
     * @return CompanyBranch
     * @Groups({"write-company_branch"})
     */
    public function setLegalName(?string $legalName): CompanyBranch
    {
        $this->legalName = $legalName;
        return $this;
    }

    /**
     * @param string|null $cpfCnpj
     * @return CompanyBranch
     * @Groups({"write-company_branch"})
     */
    public function setCpfCnpj(?string $cpfCnpj): CompanyBranch
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    /**
     * @param bool $active
     * @return CompanyBranch
     * @Groups({"write-company_branch"})
     */
    public function setActive(bool $active): CompanyBranch
    {
        $this->active = $active;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
