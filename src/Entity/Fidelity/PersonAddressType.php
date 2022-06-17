<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonAddressType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonAddressType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonAddressType extends BasePersonAddressType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string
     * @Groups({"read-person_address_type-min","read-person_address_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PersonAddressType
     * @Groups({"write-person_address_type"})
     */
    public function setName(string $name): PersonAddressType
    {
        $this->name = $name;
        return $this;
    }


//autogenerategettersetter
}
