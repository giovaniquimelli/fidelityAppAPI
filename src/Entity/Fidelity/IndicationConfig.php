<?php

namespace App\Entity\Fidelity;

use App\Entity\Fidelity\Base\BaseIndicationConfig;
use App\Repository\Fidelity\IndicationConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IndicationConfigRepository::class)
 */
class IndicationConfig extends BaseIndicationConfig
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $maxLevel = 1;
    /**
     * @ORM\Column(type="integer")
     */
    private int $maxInternalLevel = 10;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default":"0"})
     */
    private string $percentageAllocForIndication = '30';

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $lockPointsIfNotPurchase = true;
    /**
     * @ORM\Column(type="integer")
     */
    private int $lockLimitPastPurchaseInDays = 30;
    /**
     * @ORM\Column(type="integer")
     */
    private int $lockMinPastPurchaseCount = 1;
    //private bool $showAccountInfoToUpperLevels = false;
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $lockIndicationIfRegistrationIsNotComplete = true;

    // Vertical indication limit
    /**
     * @ORM\Column(type="integer")
     */
    private int $depthLimit = 1;
    // Horizontal indication limit
    /**
     * @ORM\Column(type="integer")
     */
    private int $indicationLimit = 20;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $absenceTriggersPointsBlock = true;
    // lol wth does this mean
    /**
     * @ORM\Column(type="integer")
     */
    private int $lockLimitPastPurchase = 30;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $showAccountInfoToUpperLevels = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $showPurchaseDetailsToUpperLevels = false;
}
