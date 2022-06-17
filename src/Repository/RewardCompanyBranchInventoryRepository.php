<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Person;
use App\Entity\Fidelity\Reward;
use App\Entity\Fidelity\RewardCompanyBranchInventory;
use App\Entity\Fidelity\TransactionRecord;
use App\Exception\ItemNotFoundException;
use App\Model\Base\QueryBuilderEx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method RewardCompanyBranchInventory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RewardCompanyBranchInventory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RewardCompanyBranchInventory[]    findAll()
 * @method RewardCompanyBranchInventory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RewardCompanyBranchInventoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RewardCompanyBranchInventory::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    public function findRewardSumByCompanyBranch(Reward $reward, CompanyBranch $companyBranch)
    {
        $qb = $this->createQueryBuilder('rcbi')
            ->andWhere('rcbi.deletedAt IS NULL')
            ->andWhere('rcbi.statusCode = 1')
            ->andWhere('rcbi.reward = :reward')
            ->andWhere('rcbi.companyBranch = :companyBranch')
            ->setParameter('reward', $reward)
            ->setParameter('companyBranch', $companyBranch)
            ->select('SUM(rcbi.quantity) as sum');

        $value = $qb->getQuery()->getOneOrNullResult();

        if ($value == null) {
            throw new NotFoundHttpException('Erro ao verificar quantidade disponível');
        }

        return $value;
    }
}

