<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\Person;
use App\Exception\ItemNotFoundException;
use App\Model\Base\QueryBuilderEx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Account|null find($id, $lockMode = null, $lockVersion = null)
 * @method Account|null findOneBy(array $criteria, array $orderBy = null)
 * @method Account[]    findAll()
 * @method Account[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    /**
     * @param $accountId
     * @return Account|null
     */
    public function findAccountQuickRegistrationDTO($accountId): ?Account
    {
        $qb = $this->createQueryBuilder('a');
        $qb->leftJoin('a.person', 'p')->addSelect('p');
        $qb->andWhere('a.id = :id')->setParameter('id', $accountId);

        $q = $qb->getQuery()->setMaxResults(1);

        $result = null;
        try {
            $result = $q->getOneOrNullResult(AbstractQuery::HYDRATE_OBJECT);
        } catch (\Doctrine\ORM\NonUniqueResultException $nonUniqueEx) {
        }

        return $result;
    }

    /**
     * @param string $value
     * @return Account|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUsername(string $value): ?Account
    {
        $result = $this->createQueryBuilder('a')
            ->andWhere('a.username = :username')
            ->andWhere('a.statusCode = :statusCode')
            ->andWhere('a.deletedAt IS NULL')
            ->setParameter('username', $value)
            ->setParameter('statusCode', 1)
            ->getQuery()
            ->getOneOrNullResult();

        if (empty($result)) {
            throw new ItemNotFoundException('Conta não encontrada');
        }
        return $result;
    }

    public function findAllByPerson(Person $person)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.deletedAt IS NULL')
            ->andWhere('a.statusCode = 1')
            ->andWhere('a.person = :person')
            ->setParameter('person', $person)
        ->orderBy('a.createdAt', 'ASC');
        $result = $qb->getQuery()->getResult();

        if (empty($result)) {
            throw new ItemNotFoundException('Nenhuma conta encontrada');
        }

        return $result;
    }

    public function findAllSubAccountsByMainAccountOrEmpty(Account $mainAccount, bool $getEmpty)
    {
        $qb = $this->createQueryBuilder('a')
            ->andWhere('a.deletedAt IS NULL')
            ->andWhere('a.statusCode = 1')
            ->andWhere('a.account = :mainAccount')
            ->setParameter('mainAccount', $mainAccount);
        $result = $qb->getQuery()->getResult();

        if (empty($result) && !$getEmpty) {
            throw new ItemNotFoundException('Nenhuma conta compartilhada encontrada');
        }
        return $result;
    }
}
