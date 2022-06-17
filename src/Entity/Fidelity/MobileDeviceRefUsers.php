<?php

namespace App\Entity\Fidelity;

use App\Doctrine\DefaultEntity;

use App\Entity\Fidelity\Base\BaseMobileDeviceRefUsers;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * MobileDeviceUsers
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MobileDeviceRefUsers extends BaseMobileDeviceRefUsers
{
    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="mobileDeviceUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @var MobileDevice
     *
     * @ORM\ManyToOne(targetEntity="MobileDevice", inversedBy="mobileDeviceUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobileDevice;


    public function __construct()
    {
        $this->mobileDevice = new ArrayCollection();
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getMobileDevice(): ?MobileDevice
    {
        return $this->mobileDevice;
    }

    public function setMobileDevice(?MobileDevice $mobileDevice): self
    {
        $this->mobileDevice = $mobileDevice;

        return $this;
    }
//autogenerategettersetter
}
