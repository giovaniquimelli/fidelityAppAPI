<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePushNotificationSentLog;
use Doctrine\ORM\Mapping as ORM;

/**
 * PushNotificationSentLog
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PushNotificationSentLog extends BasePushNotificationSentLog
{//autogenerategettersetter
}
