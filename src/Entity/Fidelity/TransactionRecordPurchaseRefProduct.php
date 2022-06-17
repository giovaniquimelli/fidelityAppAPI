<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseTransactionRecordPurchaseRefProduct;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;


/**
 * TransactionRecordPurchaseRefProduct
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TransactionRecordPurchaseRefProduct extends BaseTransactionRecordPurchaseRefProduct
{
    /**
     * @ORM\ManyToOne(targetEntity="TransactionRecord")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private TransactionRecord $transaction;
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     * @MaxDepth(1)
     */
    private Product $product;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPrice = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantity = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $amount = '0';

    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $unitPoints = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=5, nullable=false, options={"default": "0"})
     */
    private string $quantityPoints = '0';
    /**
     * @ORM\Column(type="decimal", precision=25, scale=10, nullable=false, options={"default": "0"})
     */
    private string $points = '0';


    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name = '';

}
