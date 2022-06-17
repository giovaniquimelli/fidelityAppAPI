<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseConfigType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ConfigType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ConfigType extends BaseConfigType
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


    //region Getters

    /**
     * @return string
     * @Groups({"read-config_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-config_type"})
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return ConfigType
     * @Groups({"write-config_type"})
     */
    public function setName(string $name): ConfigType
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return ConfigType
     * @Groups({"write-config_type"})
     */
    public function setDescription(string $description): ConfigType
    {
        $this->description = $description;
        return $this;
    }
    //endregion
}
