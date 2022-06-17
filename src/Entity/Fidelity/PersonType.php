<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonType extends BasePersonType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string
     * @Groups({"read-person_type-min","read-person_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PersonType
     * @Groups({"write-person_type"})
     */
    public function setName(string $name): PersonType
    {
        $this->name = $name;
        return $this;
    }


//autogenerategettersetter
}
