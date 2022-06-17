<?php


namespace App\Util;


use App\Util\Container\Serializer;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * TODO: Review and optimize method names
 * Class ApiPaginator
 * @package App\Util
 */
class ApiPaginator
{
    public static function paginateResult(QueryBuilder $queryBuilder, FilterPayload $filter, $type, $groups = [], $assoc = true)
    {
        $page = $filter->page;
        $pageSize = $filter->pageSize > 2000 ? 2000 : $filter->pageSize;

        $paginator = new Paginator($queryBuilder->getQuery());

        if ($assoc) {
            $paginator->getQuery()->setHydrationMode(AbstractQuery::HYDRATE_ARRAY);
        }

        $resultSet = $paginator->getIterator();

        $totalItems = $paginator->count();
        $totalPages = (int)(ceil($totalItems / $pageSize));

        $paginatorDetails = [
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
            'currentPage' => $page,
            'firstPage' => 1,
            'previousPage' => $page >= 2 ? $page - 1 : 1,
            'nextPage' => $page <= ($totalPages - 1) ? $page + 1 : $totalPages,
            'lastPage' => $totalPages,
            'currentItemsFrom' => (($page * $pageSize) - $pageSize) + 1,
            'currentItemsTo' => ((($page * $pageSize) - $pageSize) + $resultSet->count()),
        ];

        $result = $resultSet->getArrayCopy();
        if ($assoc) {
            $result = container_serializer_denormalize_collection($result, $type);
        }
        $normalized = container_serializer_normalize_collection($result, $groups);

        return ['result' => $normalized, 'pagination' => $paginatorDetails];
    }

    public static function paginate(QueryBuilder $queryBuilder, int $page = 1, int $pageSize = 50, array $groups = [], $raw = false)
    {
        // protect from abuse
        if ($pageSize > 200) {
            $pageSize = 200;
        }

        $paginator = new Paginator($queryBuilder->getQuery());

        $totalItems = count($paginator);
        $totalPages = (int)(ceil($totalItems / $pageSize));

        $resultSet = $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page - 1))
            ->setMaxResults($pageSize)
            ->execute(null, AbstractQuery::HYDRATE_OBJECT);

        // if you need manipulate $raw objects from pagination before send to client
        if ($raw) {
            return $resultSet;
        }

        $paginatorDetails = [
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
            'currentPage' => $page,
            'firstPage' => 1,
            'previousPage' => $page >= 2 ? $page - 1 : 1,
            'nextPage' => $page <= ($totalPages - 1) ? $page + 1 : $totalPages,
            'lastPage' => $totalPages,
            'currentItemsFrom' => (($page * $pageSize) - $pageSize) + 1,
            'currentItemsTo' => ((($page * $pageSize) - $pageSize) + count($resultSet)),
        ];

        $normalized = Serializer::normalizeCollection($resultSet, $groups);
        return ['result' => $normalized, 'pagination' => $paginatorDetails];

    }

    public static function paginateAssoc(string $type, Query $query, int $page = 1, int $pageSize = 50, array $groups = [], $raw = false)
    {
        // protect from abuse
        if ($pageSize > 200) {
            $pageSize = 200;
        }

        $paginator = new Paginator($query);

        $totalItems = count($paginator);
        $totalPages = (int)(ceil($totalItems / $pageSize));

        $resultSetAssoc = $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page - 1))
            ->setMaxResults($pageSize)
            ->execute(null, AbstractQuery::HYDRATE_ARRAY);

        // if you need manipulate $raw objects from pagination before send to client
        if ($raw) {
            return $resultSetAssoc;
        }

        $paginatorDetails = [
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'pageSize' => $pageSize,
            'currentPage' => $page,
            'firstPage' => 1,
            'previousPage' => $page >= 2 ? $page - 1 : 1,
            'nextPage' => $page <= ($totalPages - 1) ? $page + 1 : $totalPages,
            'lastPage' => $totalPages,
            'currentItemsFrom' => (($page * $pageSize) - $pageSize) + 1,
            'currentItemsTo' => ((($page * $pageSize) - $pageSize) + count($resultSetAssoc)),
        ];

        $resultSet = container_serializer_denormalize_collection($resultSetAssoc, $type);
        $normalized = container_serializer_normalize_collection($resultSet, $groups);
        return ['result' => $normalized, 'pagination' => $paginatorDetails];

    }

    public static function resultsAssoc(string $type, Query $query, $groups, $maxResults = 50)
    {
        // TODO: results wont be paginated
        // fetchMode: HYDRATE::ARRAY
        // Denormalize Array to Objects
        // Normalize Objects with groups
    }
}
