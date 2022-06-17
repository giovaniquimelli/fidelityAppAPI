<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseConfigCategory;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ConfigCategory
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ConfigCategory extends BaseConfigCategory
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
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var ConfigCategory
     *
     * @ORM\ManyToOne(targetEntity="ConfigCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $configCategory;

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
     * @Groups({"read-config_category"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-config_category"})
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ConfigCategory
     * @Groups({"read-config_category-relations","read-config_category-config_category"})
     */
    public function getConfigCategory(): ConfigCategory
    {
        return $this->configCategory;
    }

    /**
     * @return ConfigType
     * @Groups({"read-config_category-relations","read-config_category-config_type"})
     */
    public function getConfigType(): ConfigType
    {
        return $this->configType;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return ConfigCategory
     * @Groups({"write-config_category"})
     */
    public function setName(string $name): ConfigCategory
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return ConfigCategory
     * @Groups({"write-config_category"})
     */
    public function setDescription(string $description): ConfigCategory
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param ConfigCategory $configCategory
     * @return ConfigCategory
     */
    public function setConfigCategory(ConfigCategory $configCategory): ConfigCategory
    {
        $this->configCategory = $configCategory;
        return $this;
    }

    /**
     * @param ConfigType $configType
     * @return ConfigCategory
     */
    public function setConfigType(ConfigType $configType): ConfigCategory
    {
        $this->configType = $configType;
        return $this;
    }
    //endregion
}
