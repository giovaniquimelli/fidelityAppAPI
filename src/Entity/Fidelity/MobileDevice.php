<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BaseMobileDevice;
use App\Util\Container\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * MobileDevice
 *
 * @ORM\Entity(repositoryClass="App\Repository\MobileDeviceRepository")
 */
class MobileDevice extends BaseMobileDevice
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="push_notification_id", type="string", length=255, nullable=true)
     * @Groups({"write"})
     */
    private $pushNotificationId = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="push_notification_service", type="string", length=255, nullable=true)
     * @Groups({"write"})
     */
    private $pushNotificationService = '';

    /**
     * @var string
     *
     * @ORM\Column(name="device_id", type="string", length=255, nullable=false)
     * @Groups({"write"})
     */
    private $deviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=100, nullable=false)
     * @Groups({"write"})
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=100, nullable=false)
     * @Groups({"write"})
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=20, nullable=false)
     * @Groups({"write"})
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="os_version", type="string", length=20, nullable=false)
     * @Groups({"write"})
     */
    private $osVersion;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable_test", type="boolean", nullable=true)
     */
    private $enableTest = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_physical_device", type="boolean", nullable=true)
     * @Groups({"write"})
     */
    private $isPhysicalDevice = true;

    /**
     * @var ArrayCollection|MobileDeviceRefUsers[]|null
     *
     * @ORM\OneToMany(targetEntity="MobileDeviceRefUsers", mappedBy="mobileDevice")
     */
    private $mobileDeviceUsers;

    /**
     * @var ArrayCollection|MobileDeviceRefAccount[]|null
     *
     * @ORM\OneToMany(targetEntity="MobileDeviceRefAccount", mappedBy="mobileDevice")
     */
    private $mobileDeviceAccount;

    public function __construct()
    {
        $this->mobileDeviceUsers = new ArrayCollection();
        $this->mobileDeviceAccount = new ArrayCollection();
    }

    /**
     * @return Collection|MobileDeviceRefUsers[]
     */
    public function getMobileDeviceUsers(): Collection
    {
        return $this->mobileDeviceUsers;
    }

    public function addMobileDeviceUser(MobileDeviceRefUsers $mobileDeviceUser): self
    {
        if (!$this->mobileDeviceUsers->contains($mobileDeviceUser)) {
            $this->mobileDeviceUsers[] = $mobileDeviceUser;
            $mobileDeviceUser->setMobileDevice($this);
        }

        return $this;
    }

    public function removeMobileDeviceUser(MobileDeviceRefUsers $mobileDeviceUser): self
    {
        if ($this->mobileDeviceUsers->contains($mobileDeviceUser)) {
            $this->mobileDeviceUsers->removeElement($mobileDeviceUser);
            // set the owning side to null (unless already changed)
            if ($mobileDeviceUser->getMobileDevice() === $this) {
                $mobileDeviceUser->setMobileDevice(null);
            }
        }

        return $this;
    }


    /**
     * @return string
     */
    public function getPushNotificationId(): ?string
    {
        return $this->pushNotificationId;
    }

    /**
     * @return string
     */
    public function getPushNotificationService(): ?string
    {
        return $this->pushNotificationService;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }


    /**
     * @param string $pushNotificationId
     */
    public function setPushNotificationId(?string $pushNotificationId): void
    {
        $this->pushNotificationId = $pushNotificationId;
    }

    /**
     * @param string $pushNotificationService
     */
    public function setPushNotificationService(?string $pushNotificationService): void
    {
        $this->pushNotificationService = $pushNotificationService;
    }

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId): void
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getOs(): string
    {
        return $this->os;
    }

    /**
     * @param string $os
     */
    public function setOs(string $os): void
    {
        $this->os = $os;
    }

    /**
     * @return string
     */
    public function getOsVersion(): string
    {
        return $this->osVersion;
    }

    /**
     * @param string $osVersion
     */
    public function setOsVersion(string $osVersion): void
    {
        $this->osVersion = $osVersion;
    }

    /**
     * @return bool
     */
    public function isEnableTest(): bool
    {
        return $this->enableTest;
    }

    /**
     * @param bool $enableTest
     */
    public function setEnableTest(bool $enableTest): void
    {
        $this->enableTest = $enableTest;
    }

    /**
     * @return bool
     */
    public function isPhysicalDevice(): bool
    {
        return $this->isPhysicalDevice;
    }

    /**
     * @param bool $isPhysicalDevice
     */
    public function setIsPhysicalDevice(bool $isPhysicalDevice): void
    {
        $this->isPhysicalDevice = $isPhysicalDevice;
    }

    public function setSysAdmin(): void
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(Users::ref(container_param_get('sys_web_id')));
            }
        } else {
            $this->setUpdatedBy(Users::ref(container_param_get('sys_web_id')));
        }
    }

    public function setSysMobile(): void
    {
        if ($this->id === null) {
            $this->setCreatedBy(
                Users::ref(container_param_get('sys_mobile_id'))
            );
        } else {
            $this->setUpdatedBy(Users::ref(container_param_get('sys_mobile_id')));
        }
    }

    public function getEnableTest(): ?bool
    {
        return $this->enableTest;
    }

    public function getIsPhysicalDevice(): ?bool
    {
        return $this->isPhysicalDevice;
    }

//autogenerategettersetter
}
