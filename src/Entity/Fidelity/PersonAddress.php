<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonAddress;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonAddress
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonAddress extends BasePersonAddress
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=255, nullable=false)
     */
    private $district;

    /**
     * @var string|null
     *
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @var int
     *
     * @ORM\Column(name="zip_code", type="integer", nullable=false)
     */
    private $zipCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reference_info", type="string", length=255, nullable=true)
     */
    private $referenceInfo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="post_box", type="string", length=255, nullable=true)
     */
    private $postBox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="decimal", precision=28, scale=8, nullable=true)
     */
    private $latitude = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="decimal", precision=28, scale=8, nullable=true)
     */
    private $longitude = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="proof_address_document", type="integer", nullable=false, options={"comment"="agua, luz, telefone etc"})
     */
    private $proofAddressDocument = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="proof_address_document_code", type="string", length=255, nullable=true, options={"comment"="numero da inscricao"})
     */
    private $proofAddressDocumentCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="residential_zone", type="string", length=255, nullable=true)
     */
    private $residentialZone;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_main_address", type="boolean", nullable=false)
     */
    private $isMainAddress = false;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $city;

    /**
     * @var PersonAddressType
     *
     * @ORM\ManyToOne(targetEntity="PersonAddressType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $personAddressType;
    //endregion

    //region Getters
    /**
     * @return string
     * @Groups({"read-person_address"})
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return int
     * @Groups({"read-person_address"})
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     * @Groups({"read-person_address"})
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @return int
     * @Groups({"read-person_address"})
     */
    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getReferenceInfo(): ?string
    {
        return $this->referenceInfo;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getPostBox(): ?string
    {
        return $this->postBox;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @return int
     * @Groups({"read-person_address"})
     */
    public function getProofAddressDocument(): int
    {
        return $this->proofAddressDocument;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getProofAddressDocumentCode(): ?string
    {
        return $this->proofAddressDocumentCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_address"})
     */
    public function getResidentialZone(): ?string
    {
        return $this->residentialZone;
    }

    /**
     * @return bool
     * @Groups({"read-person_address"})
     */
    public function isMainAddress(): bool
    {
        return $this->isMainAddress;
    }

    /**
     * @return Person
     * @Groups({"read-person_address-relations","read-person_address-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return City
     * @Groups({"read-person_address-relations","read-person_address-city"})
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @return PersonAddressType
     * @Groups({"read-person_address-relations","read-person_address-person_address_type"})
     */
    public function getPersonAddressType(): PersonAddressType
    {
        return $this->personAddressType;
    }
    //endregion

    //region Setters
    /**
     * @param string $address
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setAddress(string $address): PersonAddress
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param int $number
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setNumber(int $number): PersonAddress
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param string $district
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setDistrict(string $district): PersonAddress
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @param string|null $complement
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setComplement(?string $complement): PersonAddress
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @param int $zipCode
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setZipCode(int $zipCode): PersonAddress
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @param string|null $referenceInfo
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setReferenceInfo(?string $referenceInfo): PersonAddress
    {
        $this->referenceInfo = $referenceInfo;
        return $this;
    }

    /**
     * @param string|null $postBox
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setPostBox(?string $postBox): PersonAddress
    {
        $this->postBox = $postBox;
        return $this;
    }

    /**
     * @param string|null $latitude
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setLatitude(?string $latitude): PersonAddress
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @param string|null $longitude
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setLongitude(?string $longitude): PersonAddress
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @param int $proofAddressDocument
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setProofAddressDocument(int $proofAddressDocument): PersonAddress
    {
        $this->proofAddressDocument = $proofAddressDocument;
        return $this;
    }

    /**
     * @param string|null $proofAddressDocumentCode
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setProofAddressDocumentCode(?string $proofAddressDocumentCode): PersonAddress
    {
        $this->proofAddressDocumentCode = $proofAddressDocumentCode;
        return $this;
    }

    /**
     * @param string|null $residentialZone
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setResidentialZone(?string $residentialZone): PersonAddress
    {
        $this->residentialZone = $residentialZone;
        return $this;
    }

    /**
     * @param bool $isMainAddress
     * @return PersonAddress
     * @Groups({"write-person_address"})
     */
    public function setIsMainAddress(bool $isMainAddress): PersonAddress
    {
        $this->isMainAddress = $isMainAddress;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonAddress
     */
    public function setPerson(Person $person): PersonAddress
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param City $city
     * @return PersonAddress
     */
    public function setCity(City $city): PersonAddress
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param PersonAddressType $personAddressType
     * @return PersonAddress
     */
    public function setPersonAddressType(PersonAddressType $personAddressType): PersonAddress
    {
        $this->personAddressType = $personAddressType;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
