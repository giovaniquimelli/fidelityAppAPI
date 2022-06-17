<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BasePersonPhone;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonPhone
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonPhone extends BasePersonPhone
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=false)
     */
    private $number;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extension", type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_notification", type="boolean", nullable=false)
     */
    private $enableNotification = false;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="ENUM('FIXO', 'CELULAR')"})
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var PersonPhoneType
     *
     * @ORM\ManyToOne(targetEntity="PersonPhoneType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $personPhoneType;
    //endregion

    //region Getters
    /**
     * @return string
     * @Groups({"read-person_phone-min","read-person_phone"})
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string|null
     * @Groups({"read-person_phone"})
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @return bool
     * @Groups({"read-person_phone-min","read-person_phone"})
     */
    public function isEnableNotification(): bool
    {
        return $this->enableNotification;
    }

    /**
     * @return int
     * @Groups({"read-person_phone"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string|null
     * @Groups({"read-person_phone"})
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Person
     * @Groups({"read-person_phone-relations","read-person_phone-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return PersonPhoneType
     * @Groups({"read-person_phone-relations","read-person_phone-person_phone_type"})
     */
    public function getPersonPhoneType(): PersonPhoneType
    {
        return $this->personPhoneType;
    }
    //endregion

    //region Setters
    /**
     * @param string $number
     * @return PersonPhone
     * @Groups({"write-person_phone"})
     */
    public function setNumber(string $number): PersonPhone
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param string|null $extension
     * @return PersonPhone
     * @Groups({"write-person_phone"})
     */
    public function setExtension(?string $extension): PersonPhone
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @param bool $enableNotification
     * @return PersonPhone
     * @Groups({"write-person_phone"})
     */
    public function setEnableNotification(bool $enableNotification): PersonPhone
    {
        $this->enableNotification = $enableNotification;
        return $this;
    }

    /**
     * @param int $type
     * @return PersonPhone
     * @Groups({"write-person_phone"})
     */
    public function setType(int $type): PersonPhone
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string|null $description
     * @return PersonPhone
     * @Groups({"write-person_phone"})
     */
    public function setDescription(?string $description): PersonPhone
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonPhone
     */
    public function setPerson(Person $person): PersonPhone
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param PersonPhoneType $personPhoneType
     * @return PersonPhone
     */
    public function setPersonPhoneType(PersonPhoneType $personPhoneType): PersonPhone
    {
        $this->personPhoneType = $personPhoneType;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
