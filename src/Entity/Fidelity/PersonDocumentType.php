<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonDocumentType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonDocumentType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonDocumentType extends BasePersonDocumentType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return string
     * @Groups({"read-person_document_type-min","read-person_document_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PersonDocumentType
     * @Groups({"write-person_document_type"})
     */
    public function setName(string $name): PersonDocumentType
    {
        $this->name = $name;
        return $this;
    }


//autogenerategettersetter
}
