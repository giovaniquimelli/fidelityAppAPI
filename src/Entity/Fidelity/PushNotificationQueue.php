<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePushNotificationQueue;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PushNotificationQueue
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PushNotificationQueue extends BasePushNotificationQueue
{

    /** @var int
     * Notification has failed
     */
    public const STATUS_FAILED = -1;

    /** @var int
     * Notification is on queue
     */
    public const STATUS_IN_QUEUE = 0;

    /** @var int
     * Notification has been sent
     */
    public const STATUS_SENT = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="tries", type="integer", nullable=false)
     */
    private $tries = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @var MobileDevice
     *
     * @ORM\ManyToOne(targetEntity="MobileDevice")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $mobileDevice;

    //region Getters

    /**
     * @return string
     * @Groups({"read-push_notification_queue"})
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     * @Groups({"read-push_notification_queue"})
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return MobileDevice
     * @Groups({"read-push_notification_queue-relations","read-push_notification_queue-mobile_device"})
     */
    public function getMobileDevice(): MobileDevice
    {
        return $this->mobileDevice;
    }
    //endregion

    //region Setters
    /**
     * @param string $message
     * @return PushNotificationQueue
     * @Groups({"write-push_notification_queue"})
     */
    public function setMessage(string $message): PushNotificationQueue
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param int $status
     * @return PushNotificationQueue
     * @Groups({"write-push_notification_queue"})
     */
    public function setStatus(int $status): PushNotificationQueue
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param MobileDevice $mobileDevice
     * @return PushNotificationQueue
     */
    public function setMobileDevice(MobileDevice $mobileDevice): PushNotificationQueue
    {
        $this->mobileDevice = $mobileDevice;
        return $this;
    }
    //endregion
}
