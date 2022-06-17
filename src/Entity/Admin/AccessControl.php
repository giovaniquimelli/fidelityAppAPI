<?php

namespace App\Entity\Admin;


use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * AccessControl
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class AccessControl
{
    /**
     * Default value is null even if nullable option is false, because php 7.4 typed properties must initialize values in order to access them.
     * @var UuidInterface|null
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="uuid", nullable=false, unique=true)
     */
    protected $id = null;

    /**
     * @var string|null
     * @ORM\Column(name="name_access1", type="string", length=255, nullable=true)
     */
    protected $name = '';
}
