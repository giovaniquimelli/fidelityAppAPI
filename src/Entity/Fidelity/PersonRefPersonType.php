<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonRefPersonType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonRefPersonType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonRefPersonType extends BasePersonRefPersonType
{
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var PersonType
     *
     * @ORM\ManyToOne(targetEntity="PersonType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $personType;

    /**
     * @return Person
     * @Groups({"read-person_ref_person_type-relations","read-person_ref_person_type-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return PersonType
     * @Groups({"read-person_ref_person_type-relations","read-person_ref_person_type-person_type"})
     */
    public function getPersonType(): PersonType
    {
        return $this->personType;
    }

    /**
     * @param Person $person
     * @return PersonRefPersonType
     */
    public function setPerson(Person $person): PersonRefPersonType
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param PersonType $personType
     * @return PersonRefPersonType
     */
    public function setPersonType(PersonType $personType): PersonRefPersonType
    {
        $this->personType = $personType;
        return $this;
    }
//autogenerategettersetter
}
