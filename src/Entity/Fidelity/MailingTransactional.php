<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingTransactional;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingTransactional
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingTransactional extends BaseMailingTransactional
{//autogenerategettersetter
}
