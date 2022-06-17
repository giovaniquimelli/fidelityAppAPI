<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingUnsubscribeGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingUnsubscribeGroup
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingUnsubscribeGroup extends BaseMailingUnsubscribeGroup
{//autogenerategettersetter
}
