<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentTurnstileTecnibraTimetable;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EquipmentTurnstileTecnibraTimetable
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentTurnstileTecnibraTimetable extends BaseEquipmentTurnstileTecnibraTimetable
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="numero_tabela", type="integer", nullable=true)
     */
    private $numeroTabela;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dia_tabela", type="integer", nullable=true)
     */
    private $diaTabela;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo1_entrada_inicio", type="time", nullable=true)
     */
    private $periodo1EntradaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo1_saida_inicio", type="time", nullable=true)
     */
    private $periodo1SaidaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo1_entrada_fim", type="time", nullable=true)
     */
    private $periodo1EntradaFim;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo1_saida_fim", type="time", nullable=true)
     */
    private $periodo1SaidaFim;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo2_entrada_inicio", type="time", nullable=true)
     */
    private $periodo2EntradaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo2_entrada_fim", type="time", nullable=true)
     */
    private $periodo2EntradaFim;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo2_saida_inicio", type="time", nullable=true)
     */
    private $periodo2SaidaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo2_saida_fim", type="time", nullable=true)
     */
    private $periodo2SaidaFim;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo3_entrada_inicio", type="time", nullable=true)
     */
    private $periodo3EntradaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo3_entrada_fim", type="time", nullable=true)
     */
    private $periodo3EntradaFim;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo3_saida_inicio", type="time", nullable=true)
     */
    private $periodo3SaidaInicio;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="periodo3_saida_fim", type="time", nullable=true)
     */
    private $periodo3SaidaFim;


    //region Getters

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getNumeroTabela(): ?int
    {
        return $this->numeroTabela;
    }

    /**
     * @return int|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getDiaTabela(): ?int
    {
        return $this->diaTabela;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo1EntradaInicio(): ?DateTime
    {
        return $this->periodo1EntradaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo1SaidaInicio(): ?DateTime
    {
        return $this->periodo1SaidaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo1EntradaFim(): ?DateTime
    {
        return $this->periodo1EntradaFim;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo1SaidaFim(): ?DateTime
    {
        return $this->periodo1SaidaFim;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo2EntradaInicio(): ?DateTime
    {
        return $this->periodo2EntradaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo2EntradaFim(): ?DateTime
    {
        return $this->periodo2EntradaFim;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo2SaidaInicio(): ?DateTime
    {
        return $this->periodo2SaidaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo2SaidaFim(): ?DateTime
    {
        return $this->periodo2SaidaFim;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo3EntradaInicio(): ?DateTime
    {
        return $this->periodo3EntradaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo3EntradaFim(): ?DateTime
    {
        return $this->periodo3EntradaFim;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo3SaidaInicio(): ?DateTime
    {
        return $this->periodo3SaidaInicio;
    }

    /**
     * @return DateTime|null
     * @Groups({"read-equipment_turnstile_tecnibra_timetable"})
     */
    public function getPeriodo3SaidaFim(): ?DateTime
    {
        return $this->periodo3SaidaFim;
    }
    //endregion

    //region Setters
    /**
     * @param int|null $numeroTabela
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setNumeroTabela(?int $numeroTabela): EquipmentTurnstileTecnibraTimetable
    {
        $this->numeroTabela = $numeroTabela;
        return $this;
    }

    /**
     * @param int|null $diaTabela
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setDiaTabela(?int $diaTabela): EquipmentTurnstileTecnibraTimetable
    {
        $this->diaTabela = $diaTabela;
        return $this;
    }

    /**
     * @param DateTime|null $periodo1EntradaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo1EntradaInicio(?DateTime $periodo1EntradaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo1EntradaInicio = $periodo1EntradaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo1SaidaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo1SaidaInicio(?DateTime $periodo1SaidaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo1SaidaInicio = $periodo1SaidaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo1EntradaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo1EntradaFim(?DateTime $periodo1EntradaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo1EntradaFim = $periodo1EntradaFim;
        return $this;
    }

    /**
     * @param DateTime|null $periodo1SaidaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo1SaidaFim(?DateTime $periodo1SaidaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo1SaidaFim = $periodo1SaidaFim;
        return $this;
    }

    /**
     * @param DateTime|null $periodo2EntradaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo2EntradaInicio(?DateTime $periodo2EntradaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo2EntradaInicio = $periodo2EntradaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo2EntradaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo2EntradaFim(?DateTime $periodo2EntradaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo2EntradaFim = $periodo2EntradaFim;
        return $this;
    }

    /**
     * @param DateTime|null $periodo2SaidaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo2SaidaInicio(?DateTime $periodo2SaidaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo2SaidaInicio = $periodo2SaidaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo2SaidaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo2SaidaFim(?DateTime $periodo2SaidaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo2SaidaFim = $periodo2SaidaFim;
        return $this;
    }

    /**
     * @param DateTime|null $periodo3EntradaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo3EntradaInicio(?DateTime $periodo3EntradaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo3EntradaInicio = $periodo3EntradaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo3EntradaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo3EntradaFim(?DateTime $periodo3EntradaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo3EntradaFim = $periodo3EntradaFim;
        return $this;
    }

    /**
     * @param DateTime|null $periodo3SaidaInicio
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo3SaidaInicio(?DateTime $periodo3SaidaInicio): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo3SaidaInicio = $periodo3SaidaInicio;
        return $this;
    }

    /**
     * @param DateTime|null $periodo3SaidaFim
     * @return EquipmentTurnstileTecnibraTimetable
     * @Groups({"write-equipment_turnstile_tecnibra_timetable"})
     */
    public function setPeriodo3SaidaFim(?DateTime $periodo3SaidaFim): EquipmentTurnstileTecnibraTimetable
    {
        $this->periodo3SaidaFim = $periodo3SaidaFim;
        return $this;
    }
    //endregion
}
