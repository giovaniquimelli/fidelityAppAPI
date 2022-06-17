<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseIoAccessRecord;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * IoAccessRecord
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class IoAccessRecord extends BaseIoAccessRecord
{
    //region Columns
    /**
     * @var DateTime
     *
     * @ORM\Column(name="record_datetime", type="datetime", nullable=false)
     */
    private $recordDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="terminal", type="string", length=255, nullable=false)
     */
    private $terminal;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="1 entrada 2 saida"})
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="sent", type="boolean", nullable=false)
     */
    private $sent = false;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;
    //endregion

    //region Getters
    /**
     * @return DateTime
     * @Groups({"read-io_access_record"})
     */
    public function getRecordDatetime(): DateTime
    {
        return $this->recordDatetime;
    }

    /**
     * @return string
     * @Groups({"read-io_access_record"})
     */
    public function getTerminal(): string
    {
        return $this->terminal;
    }

    /**
     * @return int
     * @Groups({"read-io_access_record"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return bool
     * @Groups({"read-io_access_record"})
     */
    public function isSent(): bool
    {
        return $this->sent;
    }

    /**
     * @return Person
     * @Groups({"read-io_access_record-relations","read-io_access_record-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-io_access_record-relations","read-io_access_record-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters
    /**
     * @param DateTime $recordDatetime
     * @return IoAccessRecord
     * @Groups({"write-io_access_record"})
     */
    public function setRecordDatetime(DateTime $recordDatetime): IoAccessRecord
    {
        $this->recordDatetime = $recordDatetime;
        return $this;
    }

    /**
     * @param string $terminal
     * @return IoAccessRecord
     * @Groups({"write-io_access_record"})
     */
    public function setTerminal(string $terminal): IoAccessRecord
    {
        $this->terminal = $terminal;
        return $this;
    }

    /**
     * @param int $type
     * @return IoAccessRecord
     * @Groups({"write-io_access_record"})
     */
    public function setType(int $type): IoAccessRecord
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $sent
     * @return IoAccessRecord
     * @Groups({"write-io_access_record"})
     */
    public function setSent(bool $sent): IoAccessRecord
    {
        $this->sent = $sent;
        return $this;
    }

    /**
     * @param Person $person
     * @return IoAccessRecord
     */
    public function setPerson(Person $person): IoAccessRecord
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return IoAccessRecord
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): IoAccessRecord
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
