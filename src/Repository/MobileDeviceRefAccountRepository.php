<?php

namespace App\Repository;

use App\Entity\Fidelity\MobileDeviceRefAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MobileDeviceRefAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileDeviceRefAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileDeviceRefAccount[]    findAll()
 * @method MobileDeviceRefAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileDeviceRefAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileDeviceRefAccount::class);
    }

    public function findOneByDeviceIdAndAccountId($deviceId, $accountId): ?MobileDeviceRefAccount
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.mobileDevice = :deviceId')
            ->andWhere('m.account = :accountId')
            ->setParameter('deviceId', $deviceId)
            ->setParameter('accountId', $accountId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
