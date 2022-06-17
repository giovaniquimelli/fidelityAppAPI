<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordExchangeRefRewardCostSharing;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordExchangeRefRewardCostSharing
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordExchangeRefRewardCostSharing extends BaseTransactionRecordExchangeRefRewardCostSharing
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;
    /**
     * @ORM\ManyToOne(targetEntity="Reward")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private Reward $reward;
    /**
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private CompanyBranch $companyBranch;
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPrice = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPoints = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantity = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $points = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $amount = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $share = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $sharePoints = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $shareAmount = '0';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $generatedAt;
}
