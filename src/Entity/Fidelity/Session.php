<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseSession;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Session
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Session extends BaseSession
{
    /**
     * @var int
     *
     * @ORM\Column(name="expire", type="integer", nullable=false)
     */
    private $expire;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", nullable=false)
     */
    private $data;


    //region Getters

    /**
     * @return int
     * @Groups({"read-session"})
     */
    public function getExpire(): int
    {
        return $this->expire;
    }

    /**
     * @return string
     * @Groups({"read-session"})
     */
    public function getData(): string
    {
        return $this->data;
    }
    //endregion

    //region Setters
    /**
     * @param int $expire
     * @return Session
     * @Groups({"write-session"})
     */
    public function setExpire(int $expire): Session
    {
        $this->expire = $expire;
        return $this;
    }

    /**
     * @param string $data
     * @return Session
     * @Groups({"write-session"})
     */
    public function setData(string $data): Session
    {
        $this->data = $data;
        return $this;
    }
    //endregion
}
