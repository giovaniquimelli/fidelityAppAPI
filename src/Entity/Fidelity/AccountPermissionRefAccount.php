<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseAccountPermissionRefAccount;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Account
 *
 * @ORM\Entity
* @ORM\HasLifecycleCallbacks()
*/
class AccountPermissionRefAccount extends BaseAccountPermissionRefAccount
{
    private UuidInterface $account; // nullable

    private bool $allowShowPoints;
    private bool $allowExchange;
    private bool $requirePlate;
    private bool $allowPointsOnDifferentAccount;

//autogenerategettersetter
}
