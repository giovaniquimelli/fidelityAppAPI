<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCountry;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Country
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Country extends BaseCountry
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
     * @ORM\Column(name="country_code", type="string", length=255, nullable=false)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", length=255, nullable=false)
     */
    private $abbreviation;

    //region Getters
    /**
     * @return string
     * @Groups({"read-country-min","read-country"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-country"})
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     * @Groups({"read-country"})
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return Country
     * @Groups({"write-country"})
     */
    public function setName(string $name): Country
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $countryCode
     * @return Country
     * @Groups({"write-country"})
     */
    public function setCountryCode(string $countryCode): Country
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @param string $abbreviation
     * @return Country
     * @Groups({"write-country"})
     */
    public function setAbbreviation(string $abbreviation): Country
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }
    //endregion


//autogenerategettersetter
}
