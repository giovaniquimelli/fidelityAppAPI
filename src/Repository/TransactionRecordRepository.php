<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\Person;
use App\Entity\Fidelity\Reward;
use App\Entity\Fidelity\TransactionRecord;
use App\Exception\ItemNotFoundException;
use App\Model\Base\QueryBuilderEx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method TransactionRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransactionRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransactionRecord[]    findAll()
 * @method TransactionRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransactionRecord::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    public function findPointsSumByAccount(Account $account)
    {
        $qb = $this->createQueryBuilder('tr')
            ->andWhere('tr.deletedAt IS NULL')
            ->andWhere('tr.statusCode = 1')
            ->andWhere('tr.account = :account')
            ->setParameter('account', $account)
            ->select('SUM(tr.points) as sum');

        $value = $qb->getQuery()->getOneOrNullResult();

        if ($value == null) {
            throw new NotFoundHttpException('Erro ao verificar pontuação disponível');
        }

        return $value;
    }

    public function findAllByAccount(Account $account, $itemsToLoad, $firstItem, $type)
    {
        $maxResults = $itemsToLoad;
        $firstResult = $firstItem;

        $qb = $this->createQueryBuilder('tr')
            ->andWhere('tr.deletedAt IS NULL')
            ->andWhere('tr.statusCode = 1')
            ->andWhere('tr.account = :account')
            ->setParameter('account', $account)
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->orderBy('tr.localDateTime', 'DESC');

        if ($type == -1) {
            $qb->andWhere('tr.points < 0');
        } else if ($type == 1) {
            $qb->andWhere('tr.points > 0');
        }

        $paginator = new Paginator($qb);

        return $paginator->getQuery()->getResult();
    }
}

