<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BasePersonFingerprint;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonFingerprint
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonFingerprint extends BasePersonFingerprint
{
    /**
     * @var int
     *
     * @ORM\Column(name="finger_index", type="integer", nullable=false)
     */
    private $fingerIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="blob", nullable=false)
     */
    private $template;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    //region Getters
    /**
     * @return int
     * @Groups({"read-person_fingerprint-min","read-person_fingerprint"})
     */
    public function getFingerIndex(): int
    {
        return $this->fingerIndex;
    }

    /**
     * @return string
     * @Groups({"read-person_fingerprint"})
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return Person
     * @Groups({"read-person_fingerprint-relations","read-person_fingerprint-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param int $fingerIndex
     * @return PersonFingerprint
     * @Groups({"write-person_fingerprint"})
     */
    public function setFingerIndex(int $fingerIndex): PersonFingerprint
    {
        $this->fingerIndex = $fingerIndex;
        return $this;
    }

    /**
     * @param string $template
     * @return PersonFingerprint
     * @Groups({"write-person_fingerprint"})
     */
    public function setTemplate(string $template): PersonFingerprint
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonFingerprint
     */
    public function setPerson(Person $person): PersonFingerprint
    {
        $this->person = $person;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
