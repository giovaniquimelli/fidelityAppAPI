<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseConfigRefConfigList;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ConfigRefConfigList
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ConfigRefConfigList extends BaseConfigRefConfigList
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var Config
     *
     * @ORM\ManyToOne(targetEntity="Config")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $config;

    /**
     * @var ConfigList
     *
     * @ORM\ManyToOne(targetEntity="ConfigList")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $configList;


    //region Getters

    /**
     * @return string|null
     * @Groups({"read-config_ref_config_list"})
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return Config
     * @Groups({"read-config_ref_config_list-relations","read-config_ref_config_list-config"})
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return ConfigList
     * @Groups({"read-config_ref_config_list-relations","read-config_ref_config_list-config_list"})
     */
    public function getConfigList(): ConfigList
    {
        return $this->configList;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $value
     * @return ConfigRefConfigList
     * @Groups({"write-config_ref_config_list"})
     */
    public function setValue(?string $value): ConfigRefConfigList
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param Config $config
     * @return ConfigRefConfigList
     */
    public function setConfig(Config $config): ConfigRefConfigList
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param ConfigList $configList
     * @return ConfigRefConfigList
     */
    public function setConfigList(ConfigList $configList): ConfigRefConfigList
    {
        $this->configList = $configList;
        return $this;
    }
    //endregion
}
