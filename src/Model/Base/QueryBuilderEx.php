<?php

namespace App\Model\Base;

use App\Util\ApiPaginator;
use App\Util\Arr;
use App\Util\FilterPayload;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class QueryBuilderEx extends BaseQueryBuilderEx
{
    /**
     * @var QueryBuilder|null
     */
    public $qb = null;

    private $page = 1;
    private $pageSize = 15;

    /**
     * @var FilterPayload
     */
    private $filterPayload = null;

    public function __construct(QueryBuilder $qb)
    {
        $this->qb = $qb;
        $this->filterPayload = new FilterPayload();
    }

    public function setFilter(FilterPayload $fp): self
    {
        $this->filterPayload = $fp;
        return $this;
    }

    public function notTrashed($alias = null): QueryBuilderEx
    {
        $_alias = $alias ?? $this->alias();
        $this->qb->andWhere("{$_alias}.deletedAt IS NULL AND {$_alias}.statusCode > -1");
        return $this;
    }

    /**
     * @param array $fields
     * @param string $paramName
     * @param array|object|string $payloadOrValue
     * @return $this
     */
    public function isearch(array $fields, $payloadOrValue, string $paramName = 'search')
    {
        $paramValue = null;
        if (is_array($payloadOrValue) || is_object($payloadOrValue)) {
            $paramValue = Arr::get($payloadOrValue, $paramName);
        }
        if ($paramValue === null) {
            return $this;
        }

        $exprs = $this->qb->expr()->orX();
        if (!Arr::isAssoc($fields)) {
            foreach ($fields as $field) {
                $exprs->add($this->qb->expr()->like("unaccent_nl({$field})", ":{$paramName}"));
            }
        } else {
            $like = Arr::get($fields, 'like');
            if (!empty($like)) {
                foreach ($like as $field) {
                    $exprs->add($this->qb->expr()->like("unaccent_nl({$field})", ":{$paramName}"));
                }
            }
            $equal = Arr::get($fields, 'eq');
            if (!empty($equal)) {
                foreach ($equal as $field) {
                    $exprs->add($this->qb->expr()->eq($field, ":searchEq"));
                }
                $this->setParameter('searchEq', $paramValue, Type::STRING);
            }
        }
        $this->qb->andWhere($exprs);
        $this->setParameterILike($paramName, $paramValue);

        return $this;
    }

    public function setParameterLike($paramName, $paramValue, $left = '%', $right = '%'): self
    {
        $this->qb->setParameter($paramName, like_sql($paramValue, $left, $right));
        return $this;
    }

    public function setParameterILike($paramName, $paramValue, $left = '%', $right = '%'): self
    {
        $this->qb->setParameter($paramName, like_sql(unaccent_nl($paramValue), $left, $right));
        return $this;
    }

    public function search(array $fields, string $paramName, $paramValue)
    {
        if ($paramValue === null) {
            return $this;
        }
        $exprs = [];
        foreach ($fields as $field) {
            $exprs[] = $this->get->expr()->like($field, ':' . $paramName);
        }

        $this->andWhere($this->expr()->orX(...$exprs));
        $this->setParameter($paramName, $paramValue);

        return $this;
    }

    public function sort($sortBy, $sortDesc): self
    {
        if (!empty($sortBy)) {
            $sortBy = "{$this->alias()}.{$sortBy}";
            $sortOrder = $sortDesc ? 'DESC' : 'ASC';
            $this->qb->orderBy($sortBy, $sortOrder);
        }
        return $this;
    }

    public function sortFromPayload($payload): void
    {
        $_sortBy = Arr::get($payload, 'sortBy');
        $_sortDesc = Arr::get($payload, 'sortDesc', false);

        if (!empty($_sortBy)) {
            $sortBy = "{$this->alias()}.{$_sortBy}";
            $sortOrder = $_sortDesc ? 'DESC' : 'ASC';
            $this->qb->orderBy($sortBy, $sortOrder);
        }
    }

    public function paginateFromPayload($payload)
    {
        $page = Arr::get($payload, 'page');
        $pageSize = Arr::get($payload, 'itemsPerPage');
        if ($page !== null && $pageSize !== null) {
            $this->page = $page;
            $this->pageSize = $pageSize;
        }
    }

    /**
     * Sort and Paginate results. $payload must contains [page, itemsPerPage(pageSize), sortBy, sortDesc]
     * @param $payload
     * @param $groups
     * @return array
     */
    public function paginate($payload, $groups, $raw = false)
    {
        $this->sortFromPayload($payload);
        $this->paginateFromPayload($payload);
        return ApiPaginator::paginate($this->qb, $this->page, $this->pageSize, $groups, $raw);
    }

    /**
     * Alternative to HYDRATE OBJECT witch is generating select queries for nested object relations
     * @param $payload
     * @param $groups
     * @param $type
     * @param $raw
     * @return array|mixed
     */
    public function paginateAssoc($payload, $groups, $type, $raw = false)
    {
        $this->sortFromPayload($payload);
        $this->paginateFromPayload($payload);
        return ApiPaginator::paginateAssoc($type, $this->qb->getQuery(), $this->page, $this->pageSize, $groups, $raw);
    }

    public function paginateResult($type, FilterPayload $filter, $groups = [], $assoc = true): array
    {
        return ApiPaginator::paginateResult($this->qb, $filter, $type, $groups, $assoc);
    }

    /**
     * Where id not equal to (and alias.id != :id).
     * @param $id string|null if guid is empty(), this where clause will be ignored
     * @return QueryBuilderEx
     */
    public function excludedId(?string $id, ?string $alias = null)
    {
        if (!empty($id)) {
            $_alias = $alias ?? $this->alias();
            $this->qb->andWhere("{$_alias}.id != :id")->setParameter('id', $id);
        }
        return $this;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    private function alias(): string
    {
        return $this->qb->getAllAliases()[0];
    }

}
