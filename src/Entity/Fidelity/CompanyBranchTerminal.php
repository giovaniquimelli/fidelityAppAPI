<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchTerminal;
use App\Util\TerminalTypes;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranch
 *
 * @ORM\Entity(repositoryClass="App\Repository\CompanyBranchRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchTerminal extends BaseCompanyBranchTerminal
{
    /**
     * @var CompanyBranch|null
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?CompanyBranch $companyBranch = null;

    /**
     * @var MobileDevice|null
     *
     * @ORM\ManyToOne(targetEntity="MobileDevice")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?MobileDevice $mobileDevice = null;

    /**
     * @var string
     *
     * @ORM\Column(name="terminal_type", type="integer", nullable=false, options={"default":"0", "comment": "TerminalTypes::DESKTOP"})
     */
    private int $terminalType = TerminalTypes::DESKTOP;

    /**
     * @var string
     *
     * @ORM\Column(name="terminal_name", type="string", length=255, nullable=false)
     */
    private string $terminalName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="terminal_mac_addr", type="string", length=255, nullable=false)
     */
    private string $terminalMacAddr = ''; // EF:E9:ED:0H|EF:E9:ED:0H pipe separated

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=20, nullable=false)
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="os_version", type="string", length=20, nullable=false)
     */
    private $osVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="computer_name", type="string", length=255, nullable=false)
     */
    private string $computerName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="system_info", type="string", length=255, nullable=false)
     */
    private string $systemInfo = '';

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
