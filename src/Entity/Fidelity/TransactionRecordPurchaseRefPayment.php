<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordPurchaseRefPayment;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordPurchaseRefPayment
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordPurchaseRefPayment extends BaseTransactionRecordPurchaseRefPayment
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;
    /**
     * @ORM\ManyToOne(targetEntity="PaymentType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private PaymentType $paymentType;
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $amount = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $tax = '0';
}
