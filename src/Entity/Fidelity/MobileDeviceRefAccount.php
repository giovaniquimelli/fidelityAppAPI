<?php

namespace App\Entity\Fidelity;

use App\Doctrine\BlamableEntity;
use App\Doctrine\DefaultEntity;
use App\Doctrine\TimestampableEntity;
use App\Entity\Fidelity\Base\BaseMobileDeviceRefAccount;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\MobileDevice;
use App\Entity\Fidelity\Users;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MobileDeviceRefAccountRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MobileDeviceRefAccount extends BaseMobileDeviceRefAccount
{
    /**
     * @var MobileDevice
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Fidelity\MobileDevice", inversedBy="mobileDevice")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mobileDevice;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Fidelity\Account", inversedBy="mobileDeviceRefAccount")
     * @ORM\JoinColumn(nullable=false)
     */
    private Account $account;

    public function getMobileDevice(): ?MobileDevice
    {
        return $this->mobileDevice;
    }

    public function setMobileDevice(?MobileDevice $mobileDevice): self
    {
        $this->mobileDevice = $mobileDevice;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

//autogenerategettersetter

    public function setSysMobile(): void
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(
                    Users::ref(container_param_get('sys_mobile_id'))
                );
            }
        } else {
            $this->setUpdatedBy(Users::ref(container_param_get('sys_mobile_id')));
        }
    }
}
