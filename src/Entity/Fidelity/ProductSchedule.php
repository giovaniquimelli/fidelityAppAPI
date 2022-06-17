<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseProductSchedule;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * ProductSchedule
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ProductSchedule extends BaseProductSchedule
{

//autogenerategettersetter
}
