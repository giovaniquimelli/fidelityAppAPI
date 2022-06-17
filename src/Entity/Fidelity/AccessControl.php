<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAccessControl;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * AccessControl
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AccessControl extends BaseAccessControl
{

}
