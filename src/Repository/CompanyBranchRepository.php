<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Person;
use App\Entity\Fidelity\Reward;
use App\Exception\ItemNotFoundException;
use App\Model\Base\QueryBuilderEx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyBranch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyBranch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyBranch[]    findAll()
 * @method CompanyBranch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyBranchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyBranch::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    public function findAllByRewardOrEmpty(Reward $reward, bool $getEmpty)
    {
        $qb = $this->createQueryBuilder('cb')
            ->andWhere('cb.deletedAt IS NULL')
            ->andWhere('cb.statusCode = 1')
            ->andWhere('cb.active = true')
            ->andWhere('rcb.showApp = true')
            ->andWhere('rcb.active = true')
            ->andWhere('rcb.deletedAt IS NULL')
            ->andWhere('rcb.statusCode = 1')
            ->andWhere('rcb.reward = :reward')
            ->andWhere('r.deletedAt IS NULL')
            ->andWhere('r.statusCode = 1')
            ->andWhere('r.rewardType = 0')
            ->andWhere('r.active = true')
            ->andWhere('r.showApp = true')
//            ->andWhere('r.id = :reward')
            ->andWhere('rcbi.deletedAt IS NULL')
            ->andWhere('rcbi.statusCode = 1')
            ->leftJoin('cb.rewardCompanyBranch', 'rcb')
            ->leftJoin('rcb.reward', 'r');

        $qb->leftJoin('App\Entity\Fidelity\RewardCompanyBranchInventory', 'rcbi', \Doctrine\ORM\Query\Expr\Join::WITH,
            $qb->expr()->andX(
                $qb->expr()->eq('rcbi.companyBranch', 'cb'),
                $qb->expr()->eq('rcbi.reward', 'r'),
            )
        );
        $qb->setParameter('reward', $reward);


//            dd($qb->getQuery()->getSQL());

        $result = $qb->getQuery()->getResult();

        if (empty($result) && !$getEmpty) {
            throw new ItemNotFoundException('Nenhuma filial encontrada');
        }
        return $result;
    }

//->leftJoin('r.rewardCompanyBranch', 'rcb', 'WITH', 'rcb.reward = r.id')
}
