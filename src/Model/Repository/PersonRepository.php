<?php


namespace App\Model\Repository;


use App\Entity\Person;
use App\Model\Base\BaseModel;
use Doctrine\ORM\AbstractQuery;

class PersonRepository extends BaseModel
{
    public function __construct()
    {
        $this->entity = new Person();
        $this->entityName = Person::class;
    }

    /**
     * @param $cpfCnpj
     * @param null $id
     * @return bool
     */
    public function cpfCnpjExist($cpfCnpj, $id = null): bool
    {
        $qb = $this->createQueryBuilderEx('p')
            ->select('p.cpfCnpj')
            ->andWhere('p.cpfCnpj=:cpfCnpj')
            ->setParameter('cpfCnpj', $cpfCnpj);

        if ($id !== null) {
            $qb->andWhere('p.id!=:id')
                ->setParameter('id', $id);
        }

        $result = $qb->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);
        if (is_array($result)) {
            return count($result) > 0;
        }
        return true;
    }
}
