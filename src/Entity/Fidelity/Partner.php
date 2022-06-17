<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePartner;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * PartnerPartners
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Partner extends BasePartner
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
     * @Groups({"read-partner-min","read-partner"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-partner"})
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Partner
     */
    public function setAddress(string $address): Partner
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-partner"})
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Partner
     */
    public function setNumber(int $number): Partner
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-partner"})
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return Partner
     */
    public function setDistrict(string $district): Partner
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-partner"})
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @param string|null $complement
     * @return Partner
     */
    public function setComplement(?string $complement): Partner
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-partner"})
     */
    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     * @return Partner
     */
    public function setZipCode(int $zipCode): Partner
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-partner"})
     */
    public function getPostBox(): ?string
    {
        return $this->postBox;
    }

    /**
     * @param string|null $postBox
     * @return Partner
     */
    public function setPostBox(?string $postBox): Partner
    {
        $this->postBox = $postBox;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-partner"})
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return Partner
     */
    public function setLatitude(?string $latitude): Partner
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-partner"})
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return Partner
     */
    public function setLongitude(?string $longitude): Partner
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return City
     * @Groups({"read-partner-relations","read-partner-city"})
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Partner
     */
    public function setCity(City $city): Partner
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     * @Groups({"read-partner-min","read-partner"})
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @return string|null
     * @Groups({"read-partner"})
     */
    public function getCpfCnpj(): ?string
    {
        return $this->cpfCnpj;
    }

    /**
     * @return bool
     * @Groups({"read-partner"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    //endregion

    //region Setters
    /**
     * @param Person $person
     * @return Partner
     */
    public function setPerson(Person $person): Partner
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param string $name
     * @return Partner
     * @Groups({"write-company_branch"})
     */
    public function setName(string $name): Partner
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $legalName
     * @return Partner
     * @Groups({"write-company_branch"})
     */
    public function setLegalName(?string $legalName): Partner
    {
        $this->legalName = $legalName;
        return $this;
    }

    /**
     * @param string|null $cpfCnpj
     * @return Partner
     * @Groups({"write-company_branch"})
     */
    public function setCpfCnpj(?string $cpfCnpj): Partner
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    /**
     * @param bool $active
     * @return Partner
     * @Groups({"write-company_branch"})
     */
    public function setActive(bool $active): Partner
    {
        $this->active = $active;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
