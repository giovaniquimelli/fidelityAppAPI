<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordPurchase;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordPurchase
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordPurchase extends BaseTransactionRecordPurchase
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;
    /**
     * @ORM\ManyToOne(targetEntity="AccountVehicle")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private AccountVehicle $accountVehicle;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $integrationType = 0; // NONE
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $guid = '';
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private string $billNumber = '';
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $billUrl = '';
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $billUuid = '';
    /**
     * @ORM\Column(type="text")
     */
    private string $billXML = '';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default":"0"})
     */
    private string $billAmount = '0';
    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $billPersonDocNumber = '';
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $billPersonDocName = '';
    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $billCarPlate = '';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $localDateTime;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private DateTime $internalDateTime;

}
