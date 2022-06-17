<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseWarehouse;
use Doctrine\ORM\Mapping as ORM;

/**
 * Warehouse
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Warehouse extends BaseWarehouse
{//autogenerategettersetter
}
