<?php

namespace App\Repository;

use App\Entity\UsersAuthToken;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersAuthToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersAuthToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersAuthToken[]    findAll()
 * @method UsersAuthToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersAuthTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersAuthToken::class);
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

    public function findOneByToken(string $token): ?UsersAuthToken
    {
        $query = $this->createQueryBuilder('uat')
            ->select('uat', 'u')
            ->andWhere('uat.token = :token')
            ->andWhere('uat.expiresAt >= :expiresAt')
            ->andWhere('uat.deletedAt IS NULL')
            ->andWhere('uat.statusCode = :statusCode')
            ->andWhere('uat.isValid = :isValid')
            ->andWhere('u.isActive = :isActive')
            ->andWhere('u.deletedAt IS NULL')
            ->andWhere('u.statusCode = :statusCode')
            ->leftJoin('uat.users', 'u')
            ->setParameter('token', $token)
            ->setParameter('expiresAt', new DateTime())
            ->setParameter('statusCode', 1)
            ->setParameter('isValid', true)
            ->setParameter('isActive', true)
            ->getQuery();
        $query->getSQL();
        return $query->getOneOrNullResult();
    }

    // public function increaseExpireTime(string $token)
}
