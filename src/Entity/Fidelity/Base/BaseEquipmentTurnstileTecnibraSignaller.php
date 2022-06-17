<?php

namespace App\Entity\Fidelity\Base;

use App\Entity\Fidelity\Users;
use DateTime;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class BaseEquipmentTurnstileTecnibraSignaller extends \App\Doctrine\BaseDefaultEntity
{
    //#region DefaultEntity

    /**
     * @return Users|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-blamable"})
     */
    public function getCreatedBy(): ?Users
    {
        return $this->createdBy;
    }

    /**
     * @param Users|null $createdBy
     * @return self
     */
    public function setCreatedBy(?Users $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return Users|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-blamable"})
     */
    public function getUpdatedBy(): ?Users
    {
        return $this->updatedBy;
    }

    /**
     * @param Users|null $updatedBy
     * @return self
     */
    public function setUpdatedBy(?Users $updatedBy): self
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * @return UuidInterface
     * @Groups({"read-equipment_turnstile_tecnibra_signaller","read-equipment_turnstile_tecnibra_signaller-min"})
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return self
     */
    public function setId(UuidInterface $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-timestampable"})
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return self
     */
    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-timestampable"})
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return self
     */
    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-trash"})
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     * @return self
     */
    public function setDeletedAt(?DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-equipment_turnstile_tecnibra_signaller-trash"})
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    //#endregion

}
