<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCountryState;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * State
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CountryState extends BaseCountryState
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_name", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $postalName;

    /**
     * @var int
     *
     * @ORM\Column(name="ibge_code", type="integer", nullable=false)
     */
    private $ibgeCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="area_code", type="string", length=255, nullable=true)
     */
    private $areaCode;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $country;

    //region Getters

    /**
     * @return string
     * @Groups({"read-country_state-min","read-country_state"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-country_state"})
     */
    public function getPostalName(): string
    {
        return $this->postalName;
    }

    /**
     * @return int
     * @Groups({"read-country_state"})
     */
    public function getIbgeCode(): int
    {
        return $this->ibgeCode;
    }

    /**
     * @return string|null
     * @Groups({"read-country_state"})
     */
    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    /**
     * @return Country
     * @Groups({"read-country_state-relations","read-country_state-country"})
     */
    public function getCountry(): Country
    {
        return $this->country;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return CountryState
     * @Groups({"write-country_state"})
     */
    public function setName(string $name): CountryState
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $postalName
     * @return CountryState
     * @Groups({"write-country_state"})
     */
    public function setPostalName(string $postalName): CountryState
    {
        $this->postalName = $postalName;
        return $this;
    }

    /**
     * @param int $ibgeCode
     * @return CountryState
     * @Groups({"write-country_state"})
     */
    public function setIbgeCode(int $ibgeCode): CountryState
    {
        $this->ibgeCode = $ibgeCode;
        return $this;
    }

    /**
     * @param string|null $areaCode
     * @return CountryState
     * @Groups({"write-country_state"})
     */
    public function setAreaCode(?string $areaCode): CountryState
    {
        $this->areaCode = $areaCode;
        return $this;
    }

    /**
     * @param Country $country
     * @return CountryState
     */
    public function setCountry(Country $country): CountryState
    {
        $this->country = $country;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
