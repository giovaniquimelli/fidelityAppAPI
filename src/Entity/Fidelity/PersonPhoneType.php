<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonPhoneType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonPhoneType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonPhoneType extends BasePersonPhoneType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


    //region Getters

    /**
     * @return string
     * @Groups({"read-person_phone_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return PersonPhoneType
     * @Groups({"write-person_phone_type"})
     */
    public function setName(string $name): PersonPhoneType
    {
        $this->name = $name;
        return $this;
    }
    //endregion
}
