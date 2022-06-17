<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BaseEmployeeSalary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * EmployeeSalary
 *
  * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class EmployeeSalary extends BaseEmployeeSalary
{
    //autogenerategettersetter
}
