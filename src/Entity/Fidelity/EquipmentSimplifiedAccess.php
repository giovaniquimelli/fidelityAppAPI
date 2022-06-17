<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEquipmentSimplifiedAccess;
use Doctrine\ORM\Mapping as ORM;

/**
 * EquipmentSimplifiedAccess
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EquipmentSimplifiedAccess extends BaseEquipmentSimplifiedAccess
{
    //autogenerategettersetter
}
