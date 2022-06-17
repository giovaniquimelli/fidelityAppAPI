<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingConfig;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingConfig
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingConfig extends BaseMailingConfig
{//autogenerategettersetter
}
