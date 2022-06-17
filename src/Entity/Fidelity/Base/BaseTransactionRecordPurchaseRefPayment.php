<?php

namespace App\Entity\Fidelity\Base;

use App\Entity\Fidelity\Users;
use DateTime;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class BaseTransactionRecordPurchaseRefPayment extends \App\Doctrine\BaseDefaultRefEntity
{
    //#region DefaultEntity

    /**
     * @return UuidInterface
     * @Groups({"read-transaction_record_purchase_ref_payment","read-transaction_record_purchase_ref_payment-min"})
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return self
     */
    public function setId(UuidInterface $id): self
    {
        $this->id = $id;
        return $this;
    }
    //#endregion

}
