<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseLog;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Log
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Log extends BaseLog
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=true)
     */
    private $userId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="table", type="string", length=255, nullable=true)
     */
    private $table;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=true)
     */
    private $action;

    /**
     * @var string|null
     *
     * @ORM\Column(name="json_doc", type="text", nullable=true)
     */
    private $jsonDoc;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $companyBranch;


    //region Getters

    /**
     * @return int|null
     * @Groups({"read-log"})
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return string|null
     * @Groups({"read-log"})
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * @return string|null
     * @Groups({"read-log"})
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @return string|null
     * @Groups({"read-log"})
     */
    public function getJsonDoc(): ?string
    {
        return $this->jsonDoc;
    }

    /**
     * @return CompanyBranch
     * @Groups({"read-log-relations","read-log-company_branch"})
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }
    //endregion

    //region Setters
    /**
     * @param int|null $userId
     * @return Log
     * @Groups({"write-log"})
     */
    public function setUserId(?int $userId): Log
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param string|null $table
     * @return Log
     * @Groups({"write-log"})
     */
    public function setTable(?string $table): Log
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param string|null $action
     * @return Log
     * @Groups({"write-log"})
     */
    public function setAction(?string $action): Log
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string|null $jsonDoc
     * @return Log
     * @Groups({"write-log"})
     */
    public function setJsonDoc(?string $jsonDoc): Log
    {
        $this->jsonDoc = $jsonDoc;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return Log
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): Log
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }
    //endregion
}
