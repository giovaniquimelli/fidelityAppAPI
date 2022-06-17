<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAccountVehicle;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * AccountVehicle
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AccountVehicle extends BaseAccountVehicle
{
    /**
     * @var Account|null
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?Account $account;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private bool $active;

    /**
     * @var string
     *
     * @ORM\Column(name="plate", type="string", length=255, nullable=false)
     */
    private string $plate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private string $type;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=false)
     */
    private string $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private string $model;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255, nullable=false)
     */
    private string $year;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private string $color;

    /**
     * @var string
     *
     * @ORM\Column(name="fuel_consumption", type="string", length=255, nullable=false)
     */
    private string $fuelConsumption;

    /**
     * @var bool
     *
     * @ORM\Column(name="imported", type="boolean", nullable=false)
     */
    private bool $imported = false;


    /**
     * @return Account|null
     * @Groups({"read-account_vehicle-relations","read-account_vehicle-account"})
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * @param Account|null $account
     */
    public function setAccount(?Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return bool
     * @Groups({"read-account_vehicle"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getPlate(): string
    {
        return $this->plate;
    }

    /**
     * @param string $plate
     */
    public function setPlate(string $plate): void
    {
        $this->plate = $plate;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     * @Groups({"read-account_vehicle"})
     */
    public function getFuelConsumption(): string
    {
        return $this->fuelConsumption;
    }

    /**
     * @param string $fuelConsumption
     */
    public function setFuelConsumption(string $fuelConsumption): void
    {
        $this->fuelConsumption = $fuelConsumption;
    }

    /**
     * @return bool
     * @Groups({"read-account_vehicle"})
     */
    public function isImported(): bool
    {
        return $this->imported;
    }

    /**
     * @param bool $imported
     */
    public function setImported(bool $imported): void
    {
        $this->imported = $imported;
    }


}
