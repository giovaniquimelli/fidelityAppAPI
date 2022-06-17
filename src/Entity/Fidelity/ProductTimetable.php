<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseProductTimetable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * ProductTimetable
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class ProductTimetable extends BaseProductTimetable
{

//autogenerategettersetter
}
