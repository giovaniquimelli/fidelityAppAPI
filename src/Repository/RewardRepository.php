<?php

namespace App\Repository;

use App\Entity\Fidelity\Account;
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
 * @method Reward|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reward|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reward[]    findAll()
 * @method Reward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RewardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reward::class);
    }

    public function createQueryBuilderEx($alias, $indexBy = null): QueryBuilderEx
    {
        return new QueryBuilderEx($this->createQueryBuilder($alias, $indexBy));
    }

    public function findAllMobileRewardsOrEmpty(bool $getEmpty)
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.deletedAt IS NULL')
            ->andWhere('r.statusCode = 1')
            ->andWhere('r.rewardType = 0')
            ->andWhere('r.active = true')
            ->andWhere('r.showApp = true')
            ->andWhere('rcb.showApp = true')
            ->andWhere('rcb.active = true')
            ->andWhere('rcb.deletedAt IS NULL')
            ->andWhere('rcb.statusCode = 1')
            ->andWhere('rcbi.deletedAt IS NULL')
            ->andWhere('rcbi.statusCode = 1')
            ->leftJoin('r.rewardCompanyBranch', 'rcb')
            ->orderBy('r.points', 'ASC');

        $qb->leftJoin('App\Entity\Fidelity\RewardCompanyBranchInventory', 'rcbi', \Doctrine\ORM\Query\Expr\Join::WITH,
            $qb->expr()->andX(
                $qb->expr()->eq('rcbi.companyBranch', 'rcb.companyBranch'),
                $qb->expr()->eq('rcbi.reward', 'r'),
            )
        );

//            dd($qb->getQuery()->getSQL());

        $result = $qb->getQuery()->getResult();

        if (empty($result) && !$getEmpty) {
            throw new ItemNotFoundException('Nenhum prêmio encontrado');
        }
        return $result;
    }

    public function findAllBranchesByRewardOrEmpty(Reward $reward, bool $getEmpty)
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.deletedAt IS NULL')
            ->andWhere('r.statusCode = 1')
            ->andWhere('r.rewardType = 0')
            ->andWhere('r.active = true')
            ->andWhere('r.showApp = true')
            ->andWhere('r.id = :reward')
            ->andWhere('rcb.showApp = true')
            ->andWhere('rcb.active = true')
            ->andWhere('rcb.deletedAt IS NULL')
            ->andWhere('rcb.statusCode = 1')
            ->andWhere('rcbi.deletedAt IS NULL')
            ->andWhere('rcbi.statusCode = 1')
            ->setParameter('reward', $reward)
            ->leftJoin('r.rewardCompanyBranch', 'rcb');

        $qb->leftJoin('App\Entity\Fidelity\RewardCompanyBranchInventory', 'rcbi', \Doctrine\ORM\Query\Expr\Join::WITH,
            $qb->expr()->andX(
                $qb->expr()->eq('rcbi.companyBranch', 'rcb.companyBranch'),
                $qb->expr()->eq('rcbi.reward', 'r'),
            )
        );
        $qb->leftJoin('App\Entity\Fidelity\CompanyBranch', 'cb', \Doctrine\ORM\Query\Expr\Join::WITH,
                $qb->expr()->eq('cb', 'rcbi.companyBranch'),
        );

//        $qb->select('cb as companyBranch, SUM(rcbi.quantity) as quantity');
        $qb->select('cb');
        $qb->addGroupBy('cb');
        $qb->having('SUM(rcbi.quantity) > 0');

//        print "<pre>";
//        print_r($qb->getQuery()->getSQL());
//        print "</pre>";
//        die();


        $result = $qb->getQuery()->getResult();

        if (empty($result) && !$getEmpty) {
            throw new ItemNotFoundException('Nenhum prêmio encontrado');
        }
        return $result;
    }

//    public function findAllBranchesByRewardOrEmpty(Reward $reward, bool $getEmpty)
//    {
//        $qb = $this->createQueryBuilder('r')
//            ->andWhere('r.deletedAt IS NULL')
//            ->andWhere('r.statusCode = 1')
//            ->andWhere('r.rewardType = 0')
//            ->andWhere('r.active = true')
//            ->andWhere('r.showApp = true')
//            ->andWhere('r.id = :reward')
//            ->andWhere('rcb.showApp = true')
//            ->andWhere('rcb.active = true')
//            ->andWhere('rcb.deletedAt IS NULL')
//            ->andWhere('rcb.statusCode = 1')
//            ->andWhere('rcbi.deletedAt IS NULL')
//            ->andWhere('rcbi.statusCode = 1')
//            ->leftJoin('r.rewardCompanyBranch', 'rcb');
//
//        $qb->leftJoin('App\Entity\Fidelity\RewardCompanyBranchInventory', 'rcbi', \Doctrine\ORM\Query\Expr\Join::WITH,
//            $qb->expr()->andX(
//                $qb->expr()->eq('rcbi.companyBranch', 'rcb.companyBranch'),
//                $qb->expr()->eq('rcbi.reward', 'r'),
//            )
//        );
//        $qb->setParameter('reward', $reward);
//
//
////            dd($qb->getQuery()->getSQL());
//
//        $result = $qb->getQuery()->getResult();
//
//        if (empty($result) && !$getEmpty) {
//            throw new ItemNotFoundException('Nenhuma filial encontrada');
//        }
//        return $result;
//    }

//->leftJoin('r.rewardCompanyBranch', 'rcb', 'WITH', 'rcb.reward = r.id')
}
