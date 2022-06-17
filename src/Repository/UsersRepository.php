<?php

namespace App\Repository;

use App\Entity\Fidelity\Users;
use App\Model\Authentication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
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


    /**
     * @param string $value
     * @return Users|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByEmail(string $value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->andWhere('u.isActive = :isActive')
            ->andWhere('u.statusCode = :statusCode')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('email', $value)
            ->setParameter('isActive', true)
            ->setParameter('statusCode', 1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getUserByAuthentication(Authentication $auth, UserPasswordEncoder $encoder): ?Users
    {
        $is_valid = false;
        $user = $this->findOneByEmail($auth->getUsername());

        if (!empty($user)) {
            $is_valid = $encoder->isPasswordValid($user, $auth->getPassword());
        }

        return $is_valid ? $user : null;
    }
}
