<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEmployee;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Employee
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Employee extends BaseEmployee
{
    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;


    //region Getters

    /**
     * @return Person
     * @Groups({"read-employee-relations","read-employee-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param Person $person
     * @return Employee
     */
    public function setPerson(Person $person): Employee
    {
        $this->person = $person;
        return $this;
    }
    //endregion
}
