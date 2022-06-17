<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCommonCancellationReason;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * CommonCancellationReason
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CommonCancellationReason extends BaseCommonCancellationReason
{
    /**
     * @var bool
     *
     * @ORM\Column(name="is_immutable", type="boolean", nullable=false)
     */
    private $isImmutable = false;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"comment"="matricula, contrato, conta, boleto ... enum"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, options={"comment"="cancelamento, "})
     */
    private $name;
    //region Getters

    /**
     * @return bool
     * @Groups({"read-common_cancellation_reason"})
     */
    public function getIsImmutable(): bool
    {
        return $this->isImmutable;
    }

    /**
     * @return int
     * @Groups({"read-common_cancellation_reason"})
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     * @Groups({"read-common_cancellation_reason"})
     */
    public function getName(): string
    {
        return $this->name;
    }
    //endregion

    //region Setters
    /**
     * @param bool $isImmutable
     * @return CommonCancellationReason
     * @Groups({"write-common_cancellation_reason"})
     */
    public function setIsImmutable(bool $isImmutable): CommonCancellationReason
    {
        $this->isImmutable = $isImmutable;
        return $this;
    }

    /**
     * @param int $type
     * @return CommonCancellationReason
     * @Groups({"write-common_cancellation_reason"})
     */
    public function setType(int $type): CommonCancellationReason
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $name
     * @return CommonCancellationReason
     * @Groups({"write-common_cancellation_reason"})
     */
    public function setName(string $name): CommonCancellationReason
    {
        $this->name = $name;
        return $this;
    }
    //endregion
}
