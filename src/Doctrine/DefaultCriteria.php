<?php


namespace App\Doctrine;


use Doctrine\Common\Collections\Criteria;

class DefaultCriteria
{
    /**
     * @return Criteria
     */
    public static function notTrashed(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('deletedAt', null))
            ->andWhere(Criteria::expr()->gte('statusCode', 0));
    }
}
