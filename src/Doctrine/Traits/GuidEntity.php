<?php


namespace App\Doctrine\Traits;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait GuidEntity
{
    /**
     * @var UuidInterface
     *
     * @ORM\Column(type="uuid", unique=true)
     */
    protected $guid;

    /**
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function prePersistGuid()
    {
        if ($this->id === null) {
            $this->setGuid(Uuid::uuid4());
        } else {
            if ($this->getGuid() === null) {
                $this->setGuid(Uuid::uuid4());
            }
        }
    }

    /**
     * @return ?UuidInterface
     */
    public function getGuid(): ?UuidInterface
    {
        return $this->guid;
    }

    /**
     * @param UuidInterface $guid
     */
    public function setGuid(UuidInterface $guid): void
    {
        $this->guid = $guid;
    }
}
