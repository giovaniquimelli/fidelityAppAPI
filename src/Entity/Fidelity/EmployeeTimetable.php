<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseEmployeeTimetable;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeTimetable
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EmployeeTimetable extends BaseEmployeeTimetable
{
    //autogenerategettersetter
}
