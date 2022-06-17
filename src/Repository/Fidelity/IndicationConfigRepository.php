<?php

namespace App\Repository\Fidelity;

use App\Entity\Fidelity\IndicationConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IndicationConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndicationConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndicationConfig[]    findAll()
 * @method IndicationConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndicationConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndicationConfig::class);
    }

    // /**
    //  * @return IndicationConfig[] Returns an array of IndicationConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndicationConfig
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
