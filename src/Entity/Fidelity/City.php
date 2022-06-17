<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BaseCity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * City
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class City extends BaseCity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ibge_code", type="string", length=255, nullable=false)
     */
    private string $ibgeCode;

    /**
     * @var CountryState
     *
     * @ORM\ManyToOne(targetEntity="CountryState")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private CountryState $countryState;

    //region Getters
    /**
     * @return string
     * @Groups({"read-city-min","read-city"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-city"})
     */
    public function getIbgeCode(): string
    {
        return $this->ibgeCode;
    }

    /**
     * @return CountryState
     * @Groups({"read-city-relations","read-city-country_state"})
     */
    public function getCountryState(): CountryState
    {
        return $this->countryState;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return City
     * @Groups({"write-city"})
     */
    public function setName(string $name): City
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $ibgeCode
     * @return City
     * @Groups({"write-city"})
     */
    public function setIbgeCode(string $ibgeCode): City
    {
        $this->ibgeCode = $ibgeCode;
        return $this;
    }

    /**
     * @param CountryState $state
     * @return City
     */
    public function setCountryState(CountryState $state): City
    {
        $this->countryState = $state;
        return $this;
    }
    //endregion



//autogenerategettersetter
}
