<?php


namespace App\Doctrine\Traits;

use Api;
use App\Entity\Users;
use Doctrine\ORM\Mapping as ORM;

trait BlamableEntityUser
{
    /**
     * @var Users|null
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true, name="created_by")
     * @\Symfony\Component\Serializer\Annotation\Groups({"read-user"})
     * @\Symfony\Component\Serializer\Annotation\MaxDepth(1)
     */
    private $createdBy;

    /**
     * @var Users|null
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true, name="updated_by")
     * @\Symfony\Component\Serializer\Annotation\Groups({"read-user"})
     * @\Symfony\Component\Serializer\Annotation\MaxDepth(1)
     */
    private $updatedBy;

    /**
     * @return Users|null
     */
    public function getUpdatedBy(): ?Users
    {
        return $this->updatedBy;
    }

    /**
     * @param Users|null $updatedBy
     */
    public function setUpdatedBy(?Users $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersistBlamable()
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                if (container_user() !== null) {
                    $this->setCreatedBy(container_user());
                }
            }
        } else {
            if (container_user() !== null) {
                $this->setUpdatedBy(container_user());
            }
        }
    }

    /**
     * @return Users|null
     */
    public function getCreatedBy(): ?Users
    {
        return $this->createdBy;
    }

    /**
     * @param Users|null $createdBy
     */
    public function setCreatedBy(?Users $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function persistedByAdmin()
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(Api::em()->getReference(Users::class, 14));
            }
        } else {
            $this->setUpdatedBy(Api::em()->getReference(Users::class, 14));
        }
    }
    public function setSysMobile()
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(
                    container_entity_manager()->getReference(
                        Users::class,
                        container_param_get('sys_mobile_id')
                    )
                );
            }
        } else {
            $this->setUpdatedBy(container_entity_manager()->getReference(Users::class, -3));
        }
    }
}
