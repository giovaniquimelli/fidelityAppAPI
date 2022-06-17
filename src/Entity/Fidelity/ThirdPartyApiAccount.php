<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseThirdPartyApiAccount;
use Doctrine\ORM\Mapping as ORM;

/**
 * ThirdPartyApiAccount
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ThirdPartyApiAccount extends BaseThirdPartyApiAccount
{//autogenerategettersetter
}
