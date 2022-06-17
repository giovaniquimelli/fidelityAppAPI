<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePoll;
use Doctrine\ORM\Mapping as ORM;

/**
 * Poll
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Poll extends BasePoll
{//autogenerategettersetter
}
