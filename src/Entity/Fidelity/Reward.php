<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseReward;
use App\Util\NumericTypes;
use App\Util\RewardTypes;
use App\Util\UnitTypes;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Reward
 *
 * @ORM\Entity(repositoryClass="App\Repository\RewardRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reward extends BaseReward
{
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name = '';
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = '';
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $technicalInfo = '';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default":"0"})
     */
    private string $points = '0';

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $price = "0";
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":"0", "comment": "NumericTypes::INTEGER"})
     */
    private int $numericType = NumericTypes::INTEGER;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":"0", "comment": "UnitTypes::UNIT"})
     */
    private int $unitType = UnitTypes::UNIT;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $active = true;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $showApp = true;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $showPOS = true;
    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": "true"})
     */
    private bool $showWebSite = true;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":"0", "comment": "RewardTypes::REWARD"})
     */
    private int $rewardType = RewardTypes::REWARD;

    /**
     * @return string
     * @Groups({"read-reward-min","read-reward"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-reward"})
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     * @Groups({"read-reward"})
     */
    public function getTechnicalInfo(): ?string
    {
        return $this->technicalInfo;
    }

    /**
     * @return string
     * @Groups({"read-reward-min","read-reward"})
     */
    public function getPoints(): string
    {
        return $this->points;
    }

    /**
     * @return string
     * @Groups({"read-reward"})
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return int
     * @Groups({"read-reward"})
     */
    public function getNumericType(): int
    {
        return $this->numericType;
    }

    /**
     * @return int
     * @Groups({"read-reward"})
     */
    public function getUnitType(): int
    {
        return $this->unitType;
    }

    /**
     * @return bool
     * @Groups({"read-reward-min","read-reward"})
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     * @Groups({"read-reward-min","read-reward"})
     */
    public function isShowApp(): bool
    {
        return $this->showApp;
    }

    /**
     * @return bool
     * @Groups({"read-reward-min","read-reward"})
     */
    public function isShowPOS(): bool
    {
        return $this->showPOS;
    }

    /**
     * @return bool
     * @Groups({"read-reward-min","read-reward"})
     */
    public function isShowWebSite(): bool
    {
        return $this->showWebSite;
    }

    /**
     * @param string $name
     * @return Reward
     */
    public function setName(string $name): Reward
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $description
     * @return Reward
     */
    public function setDescription(?string $description): Reward
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string|null $technicalInfo
     * @return Reward
     */
    public function setTechnicalInfo(?string $technicalInfo): Reward
    {
        $this->technicalInfo = $technicalInfo;
        return $this;
    }

    /**
     * @param string $points
     * @return Reward
     */
    public function setPoints(string $points): Reward
    {
        $this->points = $points;
        return $this;
    }

    /**
     * @param string $price
     * @return Reward
     */
    public function setPrice(string $price): Reward
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param int $numericType
     * @return Reward
     */
    public function setNumericType(int $numericType): Reward
    {
        $this->numericType = $numericType;
        return $this;
    }

    /**
     * @param int $unitType
     * @return Reward
     */
    public function setUnitType(int $unitType): Reward
    {
        $this->unitType = $unitType;
        return $this;
    }

    /**
     * @param bool $active
     * @return Reward
     */
    public function setActive(bool $active): Reward
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param bool $showApp
     * @return Reward
     */
    public function setShowApp(bool $showApp): Reward
    {
        $this->showApp = $showApp;
        return $this;
    }

    /**
     * @param bool $showPOS
     * @return Reward
     */
    public function setShowPOS(bool $showPOS): Reward
    {
        $this->showPOS = $showPOS;
        return $this;
    }

    /**
     * @param bool $showWebSite
     * @return Reward
     */
    public function setShowWebSite(bool $showWebSite): Reward
    {
        $this->showWebSite = $showWebSite;
        return $this;
    }

    /**
     * @return int
     * @Groups({"read-reward"})
     */
    public function getRewardType(): int
    {
        return $this->rewardType;
    }

    /**
     * @param int $rewardType
     * @return Reward
     */
    public function setRewardType(int $rewardType): Reward
    {
        $this->rewardType = $rewardType;
        return $this;
    }

}
