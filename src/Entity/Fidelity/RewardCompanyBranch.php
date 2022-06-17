<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseRewardCompanyBranch;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * RewardCompanyBranch
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class RewardCompanyBranch extends BaseRewardCompanyBranch
{
    /**
     * @var Reward
     *
     * @ORM\ManyToOne(targetEntity="Reward", inversedBy="Reward")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private Reward $reward;

    /**
     * @var CompanyBranch
     *
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @MaxDepth(1)
     */
    private CompanyBranch $companyBranch;

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

    public function __construct()
    {
        $this->companyBranch = new CompanyBranch();
    }

    /**
     * @return Reward
     */
    public function getReward(): Reward
    {
        return $this->reward;
    }

    /**
     * @return CompanyBranch
     */
    public function getCompanyBranch(): CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isShowApp(): bool
    {
        return $this->showApp;
    }

    /**
     * @return bool
     */
    public function isShowPOS(): bool
    {
        return $this->showPOS;
    }

    /**
     * @return bool
     */
    public function isShowWebSite(): bool
    {
        return $this->showWebSite;
    }

    /**
     * @param Reward $reward
     * @return RewardCompanyBranch
     */
    public function setReward(Reward $reward): RewardCompanyBranch
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return RewardCompanyBranch
     */
    public function setCompanyBranch(CompanyBranch $companyBranch): RewardCompanyBranch
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @param bool $active
     * @return RewardCompanyBranch
     */
    public function setActive(bool $active): RewardCompanyBranch
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @param bool $showApp
     * @return RewardCompanyBranch
     */
    public function setShowApp(bool $showApp): RewardCompanyBranch
    {
        $this->showApp = $showApp;
        return $this;
    }

    /**
     * @param bool $showPOS
     * @return RewardCompanyBranch
     */
    public function setShowPOS(bool $showPOS): RewardCompanyBranch
    {
        $this->showPOS = $showPOS;
        return $this;
    }

    /**
     * @param bool $showWebSite
     * @return RewardCompanyBranch
     */
    public function setShowWebSite(bool $showWebSite): RewardCompanyBranch
    {
        $this->showWebSite = $showWebSite;
        return $this;
    }


}
