<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentTurnstileTecnibraOfflineList;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentTurnstileTecnibraOfflineList
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentTurnstileTecnibraOfflineList extends BaseEquipmentTurnstileTecnibraOfflineList
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="horario", type="integer", nullable=true)
     */
    private $horario;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="liberado", type="boolean", nullable=true)
     */
    private $liberado = false;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="leitores", type="boolean", nullable=true)
     */
    private $leitores = false;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra_offline_list"})
     */
    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    /**
     * @return string|null
     * @Groups({"read-equipment_turnstile_tecnibra_offline_list"})
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra_offline_list"})
     */
    public function getHorario(): ?int
    {
        return $this->horario;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra_offline_list"})
     */
    public function getLiberado(): ?bool
    {
        return $this->liberado;
    }

    /**
     * @return bool|null
     * @Groups({"read-equipment_turnstile_tecnibra_offline_list"})
     */
    public function getLeitores(): ?bool
    {
        return $this->leitores;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $codigo
     * @return EquipmentTurnstileTecnibraOfflineList
     * @Groups({"write-equipment_turnstile_tecnibra_offline_list"})
     */
    public function setCodigo(?string $codigo): EquipmentTurnstileTecnibraOfflineList
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @param string|null $name
     * @return EquipmentTurnstileTecnibraOfflineList
     * @Groups({"write-equipment_turnstile_tecnibra_offline_list"})
     */
    public function setName(?string $name): EquipmentTurnstileTecnibraOfflineList
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int|null $horario
     * @return EquipmentTurnstileTecnibraOfflineList
     * @Groups({"write-equipment_turnstile_tecnibra_offline_list"})
     */
    public function setHorario(?int $horario): EquipmentTurnstileTecnibraOfflineList
    {
        $this->horario = $horario;
        return $this;
    }

    /**
     * @param bool|null $liberado
     * @return EquipmentTurnstileTecnibraOfflineList
     * @Groups({"write-equipment_turnstile_tecnibra_offline_list"})
     */
    public function setLiberado(?bool $liberado): EquipmentTurnstileTecnibraOfflineList
    {
        $this->liberado = $liberado;
        return $this;
    }

    /**
     * @param bool|null $leitores
     * @return EquipmentTurnstileTecnibraOfflineList
     * @Groups({"write-equipment_turnstile_tecnibra_offline_list"})
     */
    public function setLeitores(?bool $leitores): EquipmentTurnstileTecnibraOfflineList
    {
        $this->leitores = $leitores;
        return $this;
    }
    //endregion
}
