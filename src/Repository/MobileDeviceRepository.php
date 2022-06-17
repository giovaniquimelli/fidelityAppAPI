<?php

namespace App\Repository;

use App\Entity\Fidelity\MobileDevice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MobileDevice|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileDevice|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileDevice[]    findAll()
 * @method MobileDevice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileDeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileDevice::class);
    }

    // /**
    //  * @return MobileDevice[] Returns an array of MobileDevice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByDeviceId($value): ?MobileDevice
    {
        return $this->createQueryBuilder('md')
            ->andWhere('md.deviceId = :val')
            ->setParameter('val', $value)
            ->getQuery()->getOneOrNullResult();

    }
}
