<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonAccessCode;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonAccessCode
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonAccessCode extends BasePersonAccessCode
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="turnstile_code", type="string", length=255, nullable=true)
     */
    private $turnstileCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rfid_accessory_code", type="string", length=255, nullable=true)
     */
    private $rfidAccessoryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bar_code", type="string", length=255, nullable=true)
     */
    private $barCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="qr_code", type="text", nullable=true)
     */
    private $qrCode;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    //region Getters
    /**
     * @return string|null
     * @Groups({"read-person_access_code"})
     */
    public function getTurnstileCode(): ?string
    {
        return $this->turnstileCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_access_code"})
     */
    public function getRfidAccessoryCode(): ?string
    {
        return $this->rfidAccessoryCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_access_code-min","read-person_access_code"})
     */
    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    /**
     * @return string|null
     * @Groups({"read-person_access_code"})
     */
    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    /**
     * @return Person
     * @Groups({"read-person_access_code-relations","read-person_access_code-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $turnstileCode
     * @return PersonAccessCode
     * @Groups({"write-person_access_code"})
     */
    public function setTurnstileCode(?string $turnstileCode): PersonAccessCode
    {
        $this->turnstileCode = $turnstileCode;
        return $this;
    }

    /**
     * @param string|null $rfidAccessoryCode
     * @return PersonAccessCode
     * @Groups({"write-person_access_code"})
     */
    public function setRfidAccessoryCode(?string $rfidAccessoryCode): PersonAccessCode
    {
        $this->rfidAccessoryCode = $rfidAccessoryCode;
        return $this;
    }

    /**
     * @param string|null $barCode
     * @return PersonAccessCode
     * @Groups({"write-person_access_code"})
     */
    public function setBarCode(?string $barCode): PersonAccessCode
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @param string|null $qrCode
     * @return PersonAccessCode
     * @Groups({"write-person_access_code"})
     */
    public function setQrCode(?string $qrCode): PersonAccessCode
    {
        $this->qrCode = $qrCode;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonAccessCode
     */
    public function setPerson(Person $person): PersonAccessCode
    {
        $this->person = $person;
        return $this;
    }
    //endregion



//autogenerategettersetter
}
