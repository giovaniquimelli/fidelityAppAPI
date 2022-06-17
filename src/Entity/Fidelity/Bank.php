<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseBank;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Bank
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Bank extends BaseBank
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bank_code", type="string", length=255, nullable=true)
     */
    private $bankCode;


    //region Getters

    /**
     * @return string
     * @Groups({"read-bank"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     * @Groups({"read-bank"})
     */
    public function getBankCode(): ?string
    {
        return $this->bankCode;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return Bank
     * @Groups({"write-bank"})
     */
    public function setName(string $name): Bank
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $bankCode
     * @return Bank
     * @Groups({"write-bank"})
     */
    public function setBankCode(?string $bankCode): Bank
    {
        $this->bankCode = $bankCode;
        return $this;
    }
    //endregion
}
