<?php

namespace App\Doctrine;

use App\Entity\Fidelity\Users;
use App\Util\Container\ContainerService;
use App\Util\Container\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class BaseDefaultRefEntity extends BaseEntity
{
    /**
     * Default value is null even if nullable option is false, because php 7.4 typed properties must initialize values in order to access them.
     * @var UuidInterface|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="uuid", nullable=false, unique=true)
     */
    protected ?UuidInterface $id = null;


    /**
     * Pre Persist UUID_V4 -> callback sequence 3
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function prePersistId(): void
    {
        if (method_exists($this, 'setId') &&
            method_exists($this, 'getId')) {
            if ($this->id === null) {
                $this->setId(Uuid::uuid4());
            } else {
                if ($this->getId() === null) {
                    $this->setId(Uuid::uuid4());
                }
            }
        }
    }
}
