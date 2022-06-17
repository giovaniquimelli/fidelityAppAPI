<?php

namespace App\Repository;

use App\Entity\Fidelity\AccountAuthToken;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AccountAuthToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountAuthToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountAuthToken[]    findAll()
 * @method AccountAuthToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountAuthTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountAuthToken::class);
    }

    // /**
    //  * @return Users[] Returns an array of Users objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


//    /**
//     * @param string $value
//     * @return Users|null
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     */
//    public function findOneByEmail(string $value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.email = :val')
//            ->andWhere('u.isActive=1')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult();
//    }

    public function findOneByToken(string $token): ?AccountAuthToken
    {
        $query = $this->createQueryBuilder('aat')
            ->select('aat', 'u')
            ->andWhere('aat.token = :token')
            ->andWhere('aat.expiresAt >= :expiresAt')
            ->andWhere('aat.deletedAt IS NULL')
            ->andWhere('aat.statusCode = :statusCode')
            ->andWhere('aat.isValid = :isValid')
            // ->andWhere('a.isActive = :isActive')
            ->andWhere('a.deletedAt IS NULL')
            ->andWhere('a.statusCode = :statusCode')
            ->leftJoin('aat.account', 'a')
            ->setParameter('token', $token)
            ->setParameter('expiresAt', new DateTime())
            ->setParameter('statusCode', 1)
            ->setParameter('isValid', true)
            // ->setParameter('isActive', true)
            ->getQuery();
        // dd($query->getSQL());
        return $query->getOneOrNullResult();
    }

    // public function increaseExpireTime(string $token)
}
