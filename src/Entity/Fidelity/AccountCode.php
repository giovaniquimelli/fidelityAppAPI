<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAccountCode;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AccountCode
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AccountCode extends BaseAccountCode
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="turnstile_code", type="string", length=255, nullable=true)
     */
    private $turnstileCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rfid_accessory_code", type="string", length=255, nullable=true)
     */
    private $rfidAccessoryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bar_code", type="string", length=255, nullable=true)
     */
    private $barCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="qr_code", type="text", length=255, nullable=true)
     */
    private $qrCode;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="text", length=20, nullable=false)
     */
    private $code;

    //region Getters
    /**
     * @return string|null
     * @Groups({"read-account_code"})
     */
    public function getTurnstileCode(): ?string
    {
        return $this->turnstileCode;
    }

    /**
     * @return string|null
     * @Groups({"read-account_code"})
     */
    public function getRfidAccessoryCode(): ?string
    {
        return $this->rfidAccessoryCode;
    }

    /**
     * @return string|null
     * @Groups({"read-account_code"})
     */
    public function getBarCode(): ?string
    {
        return $this->barCode;
    }

    /**
     * @return string|null
     * @Groups({"read-account_code"})
     */
    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    /**
     * @return Account
     * @Groups({"read-account_code-relations","read-account_code-account"})
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return string|null
     * @Groups({"read-account_code-min","read-account_code"})
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    //endregion

    //region Setters
    /**
     * @param string|null $turnstileCode
     * @return AccountCode
     * @Groups({"write-account_code"})
     */
    public function setTurnstileCode(?string $turnstileCode): AccountCode
    {
        $this->turnstileCode = $turnstileCode;
        return $this;
    }

    /**
     * @param string|null $rfidAccessoryCode
     * @return AccountCode
     * @Groups({"write-account_code"})
     */
    public function setRfidAccessoryCode(?string $rfidAccessoryCode): AccountCode
    {
        $this->rfidAccessoryCode = $rfidAccessoryCode;
        return $this;
    }

    /**
     * @param string|null $barCode
     * @return AccountCode
     * @Groups({"write-account_code"})
     */
    public function setBarCode(?string $barCode): AccountCode
    {
        $this->barCode = $barCode;
        return $this;
    }

    /**
     * @param string|null $qrCode
     * @return AccountCode
     * @Groups({"write-account_code"})
     */
    public function setQrCode(?string $qrCode): AccountCode
    {
        $this->qrCode = $qrCode;
        return $this;
    }

    /**
     * @param Account $account
     * @return AccountCode
     */
    public function setAccount(Account $account): AccountCode
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @param string $code
     * @return AccountCode
     * @Groups({"write-account_code"})
     */
    public function setCode(string $code): AccountCode
    {
        $this->code = $code;
        return $this;
    }
    //endregion



//autogenerategettersetter
}
