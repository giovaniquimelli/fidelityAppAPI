<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BasePersonPicture;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonPicture
 *
  * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonPicture extends BasePersonPicture
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="text", nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="text", nullable=false)
     */
    private $thumbnail;

    /**
     * @var bool
     *
     * @ORM\Column(name="has_access_card", type="boolean", nullable=false)
     */
    private $hasAccessCard = false;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;
    //endregion

    //region Getters
    /**
     * @return string
     * @Groups({"read-person_picture"})
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @return string
     * @Groups({"read-person_picture-min","read-person_picture"})
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @return bool
     * @Groups({"read-person_picture"})
     */
    public function isHasAccessCard(): bool
    {
        return $this->hasAccessCard;
    }

    /**
     * @return Person
     * @Groups({"read-person_picture-relations","read-person_picture-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param string $picture
     * @return PersonPicture
     * @Groups({"write-person_picture"})
     */
    public function setPicture(string $picture): PersonPicture
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @param string $thumbnail
     * @return PersonPicture
     * @Groups({"write-person_picture"})
     */
    public function setThumbnail(string $thumbnail): PersonPicture
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    /**
     * @param bool $hasAccessCard
     * @return PersonPicture
     * @Groups({"write-person_picture"})
     */
    public function setHasAccessCard(bool $hasAccessCard): PersonPicture
    {
        $this->hasAccessCard = $hasAccessCard;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonPicture
     */
    public function setPerson(Person $person): PersonPicture
    {
        $this->person = $person;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
