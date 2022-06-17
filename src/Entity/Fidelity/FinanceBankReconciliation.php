<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceBankReconciliation;
use Doctrine\ORM\Mapping as ORM;

/**
 * FinanceBankReconciliation
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceBankReconciliation extends BaseFinanceBankReconciliation
{//autogenerategettersetter
}
