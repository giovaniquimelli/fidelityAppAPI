<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseFinanceAccountType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * FinanceAccountType
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FinanceAccountType extends BaseFinanceAccountType
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


    //region Getters

    /**
     * @return string
     * @Groups({"read-finance_account_type"})
     */
    public function getName(): string
    {
        return $this->name;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return FinanceAccountType
     * @Groups({"write-finance_account_type"})
     */
    public function setName(string $name): FinanceAccountType
    {
        $this->name = $name;
        return $this;
    }
    //endregion
}
