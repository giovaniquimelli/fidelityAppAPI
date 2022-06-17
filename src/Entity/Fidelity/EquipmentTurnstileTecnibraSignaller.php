<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentTurnstileTecnibraSignaller;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentTurnstileTecnibraSignaller
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentTurnstileTecnibraSignaller extends BaseEquipmentTurnstileTecnibraSignaller
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="dia_semana", type="integer", nullable=true)
     */
    private $diaSemana;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="horario_toque", type="time", nullable=true)
     */
    private $horarioToque;

    /**
     * @var int|null
     *
     * @ORM\Column(name="timeout", type="integer", nullable=true)
     */
    private $timeout;


    //region Getters

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller"})
     */
    public function getDiaSemana(): ?int
    {
        return $this->diaSemana;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller"})
     */
    public function getHorarioToque(): ?DateTime
    {
        return $this->horarioToque;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra_signaller"})
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }
    //endregion

    //region Setters
    /**
     * @param int|null $diaSemana
     * @return EquipmentTurnstileTecnibraSignaller
     * @Groups({"write-equipment_turnstile_tecnibra_signaller"})
     */
    public function setDiaSemana(?int $diaSemana): EquipmentTurnstileTecnibraSignaller
    {
        $this->diaSemana = $diaSemana;
        return $this;
    }

    /**
     * @param DateTime|null $horarioToque
     * @return EquipmentTurnstileTecnibraSignaller
     * @Groups({"write-equipment_turnstile_tecnibra_signaller"})
     */
    public function setHorarioToque(?DateTime $horarioToque): EquipmentTurnstileTecnibraSignaller
    {
        $this->horarioToque = $horarioToque;
        return $this;
    }

    /**
     * @param int|null $timeout
     * @return EquipmentTurnstileTecnibraSignaller
     * @Groups({"write-equipment_turnstile_tecnibra_signaller"})
     */
    public function setTimeout(?int $timeout): EquipmentTurnstileTecnibraSignaller
    {
        $this->timeout = $timeout;
        return $this;
    }
    //endregion
}
