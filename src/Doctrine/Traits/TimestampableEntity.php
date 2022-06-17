<?php

namespace App\Doctrine\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampableEntity
 * @package App\Doctrine
 */
trait TimestampableEntity
{
    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @\Symfony\Component\Serializer\Annotation\Groups({"blame", "timestamp"})
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @\Symfony\Component\Serializer\Annotation\Groups({"blame", "timestamp"})
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @\Symfony\Component\Serializer\Annotation\Groups({"trashed"})
     */
    private $deletedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="status_code", type="integer", nullable=false, options={"default": 1})
     * @\Symfony\Component\Serializer\Annotation\Groups({"trashed"})
     */
    private $statusCode = 1;

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersistTimestampable()
    {
        if($this->id === null)
        {
            $this->setCreatedAt(new DateTime());
        } else {
            if ($this->getStatusCode() !== -1) {
                $this->setUpdatedAt(new DateTime());
            }
        }
    }

    public function delete()
    {
        $this->setDeletedAt(new DateTime());
        $this->setStatusCode(-1);
    }
}
