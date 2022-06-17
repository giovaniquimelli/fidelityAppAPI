<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingMailAccount;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingMailAccount
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingMailAccount extends BaseMailingMailAccount
{//autogenerategettersetter
}
