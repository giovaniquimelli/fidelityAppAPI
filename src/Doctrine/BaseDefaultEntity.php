<?php

namespace App\Doctrine;

use App\Entity\Fidelity\Users;
use App\Util\Container\ContainerService;
use App\Util\Container\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class BaseDefaultEntity extends BaseEntity
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
     * @var Users|null
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true, name="created_by")
     * @\Symfony\Component\Serializer\Annotation\MaxDepth(1)
     */
    protected ?Users $createdBy = null;

    /**
     * @var Users|null
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true, name="updated_by")
     * @\Symfony\Component\Serializer\Annotation\MaxDepth(1)
     */
    protected ?Users $updatedBy = null;

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected ?DateTime $createdAt = null;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected ?DateTime $updatedAt = null;

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected ?DateTime $deletedAt = null;

    /**
     * @ORM\Column(name="status_code", type="integer", nullable=false, options={"default": 1})
     */
    protected int $statusCode = 1;

    /**
     * prePersist/Update -> callback sequence 1
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersistBlamable(): void
    {
        if (method_exists($this, 'getCreatedBy') &&
            method_exists($this, 'setCreatedBy') &&
            method_exists($this, 'setUpdatedBy')) {
            if ($this->id === null) {
                if (($this->getCreatedBy() === null) && container_user() !== null) {
                    $this->setCreatedBy(User::get());
                }
            } else if (container_user() !== null) {
                $this->setUpdatedBy(User::get());
            }
        }
    }

    /**
     * prePersist/Update -> callback sequence 2
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersistTimestampable(): void
    {
        if (method_exists($this, 'setCreatedAt') &&
            method_exists($this, 'getStatusCode') &&
            method_exists($this, 'setUpdatedAt')) {
            if ($this->id === null) {
                $this->setCreatedAt(new DateTime());
            } else {
                if ($this->getStatusCode() !== -1) {
                    $this->setUpdatedAt(new DateTime());
                }
            }
        }
    }

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

    public function delete(): void
    {
        if (method_exists($this, 'setDeletedAt')) {
            $this->setDeletedAt(new DateTime());
        }
        if (method_exists($this, 'setStatusCode')) {
            $this->setStatusCode(-1);
        }
    }

    public function setSysWebAdmin(): void
    {
        if (method_exists($this, 'getCreatedBy') &&
            method_exists($this, 'setCreatedBy') &&
            method_exists($this, 'setUpdatedBy')) {

            // /** @var Users|object $user */

            $user = Users::ref(ContainerService::param('sys_web_id'));
            if ($this->id === null) {
                if ($this->getCreatedBy() === null) {
                    $this->setCreatedBy($user);
                }
            } else {
                $this->setUpdatedBy($user);
            }
        }
    }
}
