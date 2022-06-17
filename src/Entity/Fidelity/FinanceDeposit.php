<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceDeposit;
use Doctrine\ORM\Mapping as ORM;

/**
 * FinanceDeposit
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceDeposit extends BaseFinanceDeposit
{//autogenerategettersetter
}
