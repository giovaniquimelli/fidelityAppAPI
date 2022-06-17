<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonMail;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonMail
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonMail extends BasePersonMail
{
    /**
     * @var string
     *
     * @ORM\Column(name="mail_account", type="string", length=255, nullable=false)
     */
    private $mailAccount;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_notification", type="boolean", nullable=false)
     */
    private $enableNotification = false;

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

    //region Getters
    /**
     * @return string
     * @Groups({"read-person_mail-min","read-person_mail"})
     */
    public function getMailAccount(): string
    {
        return $this->mailAccount;
    }

    /**
     * @return bool
     * @Groups({"read-person_mail-min","read-person_mail"})
     */
    public function isEnableNotification(): bool
    {
        return $this->enableNotification;
    }

    /**
     * @return string|null
     * @Groups({"read-person_mail"})
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Person
     * @Groups({"read-person_mail-relations","read-person_mail-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
    //endregion

    //region Setters
    /**
     * @param string $mailAccount
     * @return PersonMail
     * @Groups({"write-person_mail"})
     */
    public function setMailAccount(string $mailAccount): PersonMail
    {
        $this->mailAccount = $mailAccount;
        return $this;
    }

    /**
     * @param bool $enableNotification
     * @return PersonMail
     * @Groups({"write-person_mail"})
     */
    public function setEnableNotification(bool $enableNotification): PersonMail
    {
        $this->enableNotification = $enableNotification;
        return $this;
    }

    /**
     * @param string|null $description
     * @return PersonMail
     * @Groups({"write-person_mail"})
     */
    public function setDescription(?string $description): PersonMail
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonMail
     */
    public function setPerson(Person $person): PersonMail
    {
        $this->person = $person;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
