<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\Person;
use App\Entity\Fidelity\Reward;
use App\Entity\Fidelity\TransactionRecord;
use App\Entity\Fidelity\TransactionRecordExchangeRefReward;
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
 * @method TransactionRecordExchangeRefReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransactionRecordExchangeRefReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransactionRecordExchangeRefReward[]    findAll()
 * @method TransactionRecordExchangeRefReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRecordExchangeRefRewardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransactionRecordExchangeRefReward::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    public function findAllPaginatedByAccount(Account $account, $itemsToLoad, $firstItem)
    {
        $maxResults = $itemsToLoad;
        $firstResult = $firstItem;

        $qb = $this->createQueryBuilder('trerr')
            ->andWhere('tr.account = :account')
            ->leftJoin('trerr.transaction', 'tr')
            ->setParameter('account', $account)
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->orderBy('trerr.createdAt', 'DESC');

        $qb->leftJoin('App\Entity\Fidelity\TransactionRecordExchange', 'tre', \Doctrine\ORM\Query\Expr\Join::WITH,
            $qb->expr()->eq('tr', 'tre.transaction'),
        );

        $qb->leftJoin('tr.companyBranch', 'cb');
//
        $qb->select(
            'trerr as transactionRecordExchangeRefReward,
            cb.name as companyBranchName,
            tr.code as transactionCode,
            tre.status as transactionStatus'
        );
        // $qb->addGroupBy('tr');
        //($qb->getQuery()->getSQL());

        $paginator = new Paginator($qb);

        return $paginator->getQuery()->getResult();
    }
}

