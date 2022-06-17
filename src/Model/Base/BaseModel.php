<?php


namespace App\Model\Base;


use App\Exception\ApiException;
use App\Exception\EmptyGuidException;
use App\Exception\ItemNotFoundException;
use App\Exception\PayloadDeserializationException;
use App\Util\ApiResponseBag;
use App\Util\Arr;
use Closure;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\ORMException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class BaseModel
{
    protected $payload = null;

    protected $entity = null;

    protected $entityName = '';

    /**
     * Get value from payload
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getValue($key, $default = null)
    {
        return Arr::get($this->payload, $key, $default);
    }

    public function createQueryBuilderEx($alias, $entity = null, $indexBy = null): QueryBuilderEx
    {
        return
            new QueryBuilderEx(
                db()->getRepository($entity ?? $this->entityName)->createQueryBuilder($alias)
            );
    }

    protected static function staticQueryBuilderEx($alias, $entity = null, $indexBy = null): QueryBuilderEx
    {
        return
            new QueryBuilderEx(
                db()->getRepository(static::$className)->createQueryBuilder($alias)
            );
    }

    protected function deserializer($data, $className, $groups, $obj = null)
    {
        try {
            return container_serializer_deserialize(
                json_encode($data),
                $className,
                $groups,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $obj]
            );
        } catch (\Exception $ex) {
            throw new PayloadDeserializationException(null, null, null, null, $ex);
        }
    }

    private function findByGuid(string $guid, string $entityName = null, $throwError = true)
    {
        if (empty($guid)) {
            throw new EmptyGuidException();
        }

        $repo = db()->getRepository($entityName ?? $this->entityName);
        $byGuid = $repo->findOneBy(['guid' => $guid, 'deletedAt' => null, 'statusCode' => 1]);

        // $this->entity = $byGuid;
        if (empty($byGuid)) {
            throw new ItemNotFoundException();
        }
        return $byGuid;
    }

    protected function findById(string $id, string $entityName = null, $throwError = true)
    {
        if (empty($id)) {
            throw new EmptyGuidException();
        }

        $repo = db()->getRepository($entityName ?? $this->entityName);
        $byId = $repo->findOneBy(['id' => $id, 'deletedAt' => null, 'statusCode' => 1]);

        // $this->entity = $byGuid;
        if (empty($byId)) {
            throw new ItemNotFoundException();
        }
        return $byId;
    }

    /**
     * Find Last Result on table
     *
     * ex.: dql(tbl.field = id ORDER BY tbl.fieldDesc DESC LIMIT 1)
     *
     * dql result: sql(tbl.field_id = id ORDER BY tbl.field_desc DESC LIMIT 1
     * @param $field
     * @param $id
     * @param $fieldDesc
     * @param $entityName
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function findLastByRefId($field, $id, $fieldDesc, $entityName)
    {
        $qb = $this->createQueryBuilderEx('tbl', $entityName);
        $qb->where("tbl.{$field} = :id")->setParameter('id', $id)
            ->orderBy("tbl.{$fieldDesc}", 'DESC')
            ->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult(AbstractQuery::HYDRATE_OBJECT);
    }

    /**
     * @param Closure|callable $func
     * @param bool $transactional
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function execute($func, $transactional = true, $getResponse = true)
    {
        $response = null;
        if ($transactional) {
            db()->beginTransaction();
        }
        try {
            $response = $func();
        } catch (ApiException $apiEx) {
            if ($transactional) {
                db()->rollback();
            }
            $response = ApiResponseBag::fail($apiEx);
        } catch (\Exception $ex) {
            if ($transactional) {
                db()->rollback();
            }
            $response = ApiResponseBag::unknownError($ex);
            // $response->setMessage('Ocorreu um erro inesperado.'); << somente em produção
        }
        return $getResponse ? $response->getResponse() : $response;
    }


}
