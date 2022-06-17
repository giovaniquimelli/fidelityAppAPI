<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailing;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mailing
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Mailing extends BaseMailing
{//autogenerategettersetter
}
