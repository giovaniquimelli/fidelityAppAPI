<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingCampaign;
use Doctrine\ORM\Mapping as ORM;

/**
 * MailingCampaign
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingCampaign extends BaseMailingCampaign
{//autogenerategettersetter
}
