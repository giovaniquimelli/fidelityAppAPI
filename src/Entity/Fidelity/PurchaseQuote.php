<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePurchaseQuote;
use Doctrine\ORM\Mapping as ORM;

/**
 * PurchaseQuote
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PurchaseQuote extends BasePurchaseQuote
{//autogenerategettersetter
}
