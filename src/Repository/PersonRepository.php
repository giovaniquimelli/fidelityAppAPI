<?php

namespace App\Repository;

use App\Entity\Person;
use App\Model\Base\QueryBuilderEx;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends EntityRepository
{
    public function findPersonTypeByCpf($value, $type) {
        $types = [
            'u' => 'user'
        ];

        $sql = "SELECT p.id FROM person p LEFT JOIN {$types[$type]} s ON p.id = s.person_id WHERE p.cpf_cnpj = :cpf AND s.id IS NULL";

        $query = db()
            ->getConnection()
            ->executeQuery($sql, ['cpf' => $value]);
        if($query->rowCount() < 1) {
            return null;
        }
        $id = $query->fetch(\PDO::FETCH_ASSOC);
        return true;
    }

    public function findOneByCpfCnpj($value, $type = ''): ?Person
    {
        $qb =  $this->createQueryBuilder('p')
            ->andWhere('p.cpfCnpj = :val')
            ->leftJoin('p.personIndividual', 'pi')->addSelect('pi')
            ->setParameter('val', $value);


        return $qb->getQuery()->getOneOrNullResult();
    }
}
