<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonLegal;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonLegal
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonLegal extends BasePersonLegal
{
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @return Person
     * @Groups({"read-person_legal-relations","read-person_legal-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return PersonLegal
     */
    public function setPerson(Person $person): PersonLegal
    {
        $this->person = $person;
        return $this;
    }


//autogenerategettersetter
}
