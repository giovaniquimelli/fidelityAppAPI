<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceCashFlow;
use Doctrine\ORM\Mapping as ORM;

/**
 * FinanceCashFlow
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceCashFlow extends BaseFinanceCashFlow
{//autogenerategettersetter
}
