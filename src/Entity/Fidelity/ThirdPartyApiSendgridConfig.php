<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseThirdPartyApiSendgridConfig;
use Doctrine\ORM\Mapping as ORM;

/**
 * ThirdPartyApiSendgridConfig
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ThirdPartyApiSendgridConfig extends BaseThirdPartyApiSendgridConfig
{//autogenerategettersetter
}
