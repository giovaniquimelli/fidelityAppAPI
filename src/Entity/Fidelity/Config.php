<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseConfig;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Config
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Config extends BaseConfig
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


    /**
     * @var ConfigType
     *
     * @ORM\ManyToOne(targetEntity="ConfigType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $configType;


    //region Getters

    /**
     * @return string
     * @Groups({"read-config"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ConfigType
     * @Groups({"read-config-relations","read-config-config_type"})
     */
    public function getConfigType(): ConfigType
    {
        return $this->configType;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return Config
     * @Groups({"write-config"})
     */
    public function setName(string $name): Config
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param ConfigType $configType
     * @return Config
     */
    public function setConfigType(ConfigType $configType): Config
    {
        $this->configType = $configType;
        return $this;
    }
    //endregion
}
