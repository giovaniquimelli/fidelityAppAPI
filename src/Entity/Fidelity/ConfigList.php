<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseConfigList;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ConfigList
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ConfigList extends BaseConfigList
{
    /**
     * @var string
     *
     * @ORM\Column(name="config_code", type="string", length=255, nullable=false)
     */
    private $configCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="default_value", type="text", nullable=true)
     */
    private $defaultValue;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="data_type", type="integer", nullable=false)
     */
    private $dataType;

    /**
     * @var ConfigCategory
     *
     * @ORM\ManyToOne(targetEntity="ConfigCategory")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $configCategory;


    //region Getters

    /**
     * @return string
     * @Groups({"read-config_list"})
     */
    public function getConfigCode(): string
    {
        return $this->configCode;
    }

    /**
     * @return string
     * @Groups({"read-config_list"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-config_list"})
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @return string
     * @Groups({"read-config_list"})
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     * @Groups({"read-config_list"})
     */
    public function getDataType(): int
    {
        return $this->dataType;
    }

    /**
     * @return ConfigCategory
     * @Groups({"read-config_list-relations","read-config_list-config_category"})
     */
    public function getConfigCategory(): ConfigCategory
    {
        return $this->configCategory;
    }
    //endregion

    //region Setters
    /**
     * @param string $configCode
     * @return ConfigList
     * @Groups({"write-config_list"})
     */
    public function setConfigCode(string $configCode): ConfigList
    {
        $this->configCode = $configCode;
        return $this;
    }

    /**
     * @param string $name
     * @return ConfigList
     * @Groups({"write-config_list"})
     */
    public function setName(string $name): ConfigList
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $defaultValue
     * @return ConfigList
     * @Groups({"write-config_list"})
     */
    public function setDefaultValue(?string $defaultValue): ConfigList
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @param string $description
     * @return ConfigList
     * @Groups({"write-config_list"})
     */
    public function setDescription(string $description): ConfigList
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $dataType
     * @return ConfigList
     * @Groups({"write-config_list"})
     */
    public function setDataType(int $dataType): ConfigList
    {
        $this->dataType = $dataType;
        return $this;
    }

    /**
     * @param ConfigCategory $configCategory
     * @return ConfigList
     */
    public function setConfigCategory(ConfigCategory $configCategory): ConfigList
    {
        $this->configCategory = $configCategory;
        return $this;
    }
    //endregion
}
