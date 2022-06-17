<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingSentLog;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingSentLog
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingSentLog extends BaseMailingSentLog
{//autogenerategettersetter
}
