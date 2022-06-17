<?php

namespace App\Model\Base;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;

/**
 * Class QueryBuilderExtended
 * @package App\Model
 * @property QueryBuilder qb
 */
class BaseQueryBuilderEx
{
    /**
     *
     * Enable/disable second level query (result) caching for this query.
     *
     * @param boolean $cacheable
     *
     * @return self
     */
    public function setCacheable($cacheable): self
    {
        $this->qb->setCacheable($cacheable);
        return $this;
    }

    /**
     * @return boolean TRUE if the query results are enable for second level cache, FALSE otherwise.
     */
    public function isCacheable(): bool
    {
        return $this->qb->isCacheable();
    }

    /**
     * @param string $cacheRegion
     *
     * @return self
     */
    public function setCacheRegion($cacheRegion): self
    {
        $this->qb->setCacheRegion($cacheRegion);
        return $this;
    }

    /**
     * Obtain the name of the second level query cache region in which query results will be stored
     *
     * @return string|null The cache region name; NULL indicates the default region.
     */
    public function getCacheRegion(): ?string
    {
        return $this->qb->getCacheRegion();
    }

    /**
     * @return integer
     */
    public function getLifetime(): int
    {
        return $this->qb->getLifetime();
    }

    /**
     * Sets the life-time for this query into second level cache.
     *
     * @param integer $lifetime
     *
     * @return self
     */
    public function setLifetime($lifetime): self
    {
        $this->qb->setLifetime($lifetime);
        return $this;
    }

    /**
     * @return integer
     */
    public function getCacheMode(): int
    {
        return $this->qb->getCacheMode();
    }

    /**
     * @param integer $cacheMode
     *
     * @return self
     */
    public function setCacheMode($cacheMode): self
    {
        $this->qb->setCacheMode($cacheMode);
        return $this;
    }

    /**
     * Gets the type of the currently built query.
     *
     * @return integer
     */
    public function getType(): int
    {
        return $this->qb->getType();
    }

    /**
     * Gets the associated EntityManager for this query builder.
     *
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->qb->getEntityManager();
    }

    /**
     * Gets the state of this query builder instance.
     *
     * @return integer Either QueryBuilder::STATE_DIRTY or QueryBuilder::STATE_CLEAN.
     */
    public function getState(): int
    {
        return $this->qb->getState();
    }

    /**
     * Gets the complete DQL string formed by the current specifications of this QueryBuilder.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *     echo $qb->getDql(); // SELECT u FROM User u
     * </code>
     *
     * @return string The DQL query string.
     */
    public function getDQL(): string
    {
        return $this->qb->getDQL();
    }

    /**
     * Constructs a Query instance from the current specifications of the builder.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *     $q = $qb->getQuery();
     *     $results = $q->execute();
     * </code>
     *
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->qb->getQuery();
    }

    /**
     * Gets the FIRST root alias of the query. This is the first entity alias involved
     * in the construction of the query.
     *
     * <code>
     * $qb = $em->createQueryBuilder()
     *     ->select('u')
     *     ->from('User', 'u');
     *
     * echo $qb->getRootAlias(); // u
     * </code>
     *
     * @return string
     * @throws \RuntimeException
     *
     * @deprecated Please use $qb->getRootAliases() instead.
     */
    public function getRootAlias(): string
    {
        return $this->qb->getRootAlias();
    }

    /**
     * Gets the root aliases of the query. This is the entity aliases involved
     * in the construction of the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *
     *     $qb->getRootAliases(); // array('u')
     * </code>
     *
     * @return array
     */
    public function getRootAliases(): array
    {
        return $this->qb->getRootAliases();
    }

    /**
     * Gets all the aliases that have been used in the query.
     * Including all select root aliases and join aliases
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->join('u.articles','a');
     *
     *     $qb->getAllAliases(); // array('u','a')
     * </code>
     * @return array
     */
    public function getAllAliases(): array
    {
        return $this->qb->getAllAliases();
    }

    /**
     * Gets the root entities of the query. This is the entity aliases involved
     * in the construction of the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     *
     *     $qb->getRootEntities(); // array('User')
     * </code>
     *
     * @return array
     */
    public function getRootEntities(): array
    {
        return $this->qb->getRootEntities();
    }

    /**
     * Sets a query parameter for the query being constructed.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = :user_id')
     *         ->setParameter('user_id', 1);
     * </code>
     *
     * @param string|integer $key The parameter position or name.
     * @param mixed $value The parameter value.
     * @param string|integer|null $type PDO::PARAM_* or \Doctrine\DBAL\Types\Type::* constant
     *
     * @return self
     */
    public function setParameter($key, $value, $type = null): self
    {
        $this->qb->setParameter($key, $value, $type);
        return $this;
    }

    /**
     * Sets a collection of query parameters for the query being constructed.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = :user_id1 OR u.id = :user_id2')
     *         ->setParameters(new ArrayCollection(array(
     *             new Parameter('user_id1', 1),
     *             new Parameter('user_id2', 2)
     *        )));
     * </code>
     *
     * @param ArrayCollection|array $parameters The query parameters to set.
     *
     * @return self
     */
    public function setParameters($parameters): self
    {
        $this->qb->setParameters($parameters);
        return $this;
    }

    /**
     * Gets all defined query parameters for the query being constructed.
     *
     * @return ArrayCollection The currently defined query parameters.
     */
    public function getParameters(): ArrayCollection
    {
        return $this->qb->getParameters();
    }

    /**
     * Gets a (previously set) query parameter of the query being constructed.
     *
     * @param mixed $key The key (index or name) of the bound parameter.
     *
     * @return Query\Parameter|null The value of the bound parameter.
     */
    public function getParameter($key): ?Query\Parameter
    {
        return $this->qb->getParameter($key);
    }

    /**
     * Sets the position of the first result to retrieve (the "offset").
     *
     * @param integer $firstResult The first result to return.
     *
     * @return self
     */
    public function setFirstResult($firstResult): self
    {
        $this->qb->setFirstResult($firstResult);
        return $this;
    }

    /**
     * Gets the position of the first result the query object was set to retrieve (the "offset").
     * Returns NULL if {@link setFirstResult} was not applied to this QueryBuilder.
     *
     * @return integer The position of the first result.
     */
    public function getFirstResult(): int
    {
        return $this->qb->getFirstResult();
    }

    /**
     * Sets the maximum number of results to retrieve (the "limit").
     *
     * @param integer|null $maxResults The maximum number of results to retrieve.
     *
     * @return self
     */
    public function setMaxResults($maxResults): self
    {
        $this->qb->setMaxResults($maxResults);
        return $this;
    }

    public function setPaginate($page, $pageSize): self
    {
        $this->qb->setFirstResult($pageSize * ($page - 1));
        $this->qb->setMaxResults($pageSize);

        return $this;
    }

    /**
     * Gets the maximum number of results the query object was set to retrieve (the "limit").
     * Returns NULL if {@link setMaxResults} was not applied to this query builder.
     *
     * @return integer|null Maximum number of results.
     */
    public function getMaxResults(): ?int
    {
        return $this->qb->getMaxResults();
    }

    /**
     * Either appends to or replaces a single, generic query part.
     *
     * The available parts are: 'select', 'from', 'join', 'set', 'where',
     * 'groupBy', 'having' and 'orderBy'.
     *
     * @param string $dqlPartName The DQL part name.
     * @param object|array $dqlPart An Expr object.
     * @param bool $append Whether to append (true) or replace (false).
     *
     * @return self
     */
    public function add($dqlPartName, $dqlPart, $append = false): self
    {
        $this->qb->add($dqlPartName, $dqlPart, $append);
        return $this;
    }

    /**
     * Specifies an item that is to be returned in the query result.
     * Replaces any previously specified selections, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u', 'p')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p');
     * </code>
     *
     * @param mixed $select The selection expressions.
     *
     * @return self
     */
    public function select($select = null): self
    {
        $this->qb->select($select);
        return $this;
    }

    /**
     * Adds a DISTINCT flag to this query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->distinct()
     *         ->from('User', 'u');
     * </code>
     *
     * @param bool $flag
     *
     * @return self
     */
    public function distinct($flag = true): self
    {
        $this->qb->distinct($flag);
        return $this;
    }

    /**
     * Adds an item that is to be returned in the query result.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->addSelect('p')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p');
     * </code>
     *
     * @param mixed $select The selection expression.
     *
     * @return self
     */
    public function addSelect($select = null): self
    {
        $this->qb->addSelect($select);
        return $this;
    }

    /**
     * Turns the query being built into a bulk delete query that ranges over
     * a certain entity type.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->delete('User', 'u')
     *         ->where('u.id = :user_id')
     *         ->setParameter('user_id', 1);
     * </code>
     *
     * @param string $delete The class/type whose instances are subject to the deletion.
     * @param string $alias The class/type alias used in the constructed query.
     *
     * @return self
     */
    public function delete($delete = null, $alias = null): self
    {
        $this->qb->delete($delete, $alias);
        return $this;
    }

    /**
     * Turns the query being built into a bulk update query that ranges over
     * a certain entity type.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->update('User', 'u')
     *         ->set('u.password', '?1')
     *         ->where('u.id = ?2');
     * </code>
     *
     * @param string $update The class/type whose instances are subject to the update.
     * @param string $alias The class/type alias used in the constructed query.
     *
     * @return self
     */
    public function update($update = null, $alias = null): self
    {
        $this->qb->update($update, $alias);
        return $this;
    }

    /**
     * Creates and adds a query root corresponding to the entity identified by the given alias,
     * forming a cartesian product with any existing query roots.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u');
     * </code>
     *
     * @param string $from The class name.
     * @param string $alias The alias of the class.
     * @param string $indexBy The index for the from.
     *
     * @return self
     */
    public function from($from, $alias, $indexBy = null): self
    {
        $this->qb->from($from, $alias, $indexBy);
        return $this;
    }

    /**
     * Updates a query root corresponding to an entity setting its index by. This method is intended to be used with
     * EntityRepository->createQueryBuilder(), which creates the initial FROM clause and do not allow you to update it
     * setting an index by.
     *
     * <code>
     *     $qb = $userRepository->createQueryBuilder('u')
     *         ->indexBy('u', 'u.id');
     *
     *     // Is equivalent to...
     *
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u', 'u.id');
     * </code>
     *
     * @param string $alias The root alias of the class.
     * @param string $indexBy The index for the from.
     *
     * @return self
     *
     * @throws Query\QueryException
     */
    public function indexBy($alias, $indexBy): self
    {
        $this->qb->indexBy($alias, $indexBy);
        return $this;
    }

    /**
     * Creates and adds a join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->join('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     * </code>
     *
     * @param string $join The relationship to join.
     * @param string $alias The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition The condition for the join.
     * @param string|null $indexBy The index for the join.
     *
     * @return self
     */
    public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null): self
    {
        $this->qb->join($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * Creates and adds a join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     *     [php]
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->innerJoin('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     *
     * @param string $join The relationship to join.
     * @param string $alias The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition The condition for the join.
     * @param string|null $indexBy The index for the join.
     *
     * @return self
     */
    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null): self
    {
        $this->qb->innerJoin($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * Creates and adds a left join over an entity association to the query.
     *
     * The entities in the joined association will be fetched as part of the query
     * result if the alias used for the joined association is placed in the select
     * expressions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->leftJoin('u.Phonenumbers', 'p', Expr\Join::WITH, 'p.is_primary = 1');
     * </code>
     *
     * @param string $join The relationship to join.
     * @param string $alias The alias of the join.
     * @param string|null $conditionType The condition type constant. Either ON or WITH.
     * @param string|null $condition The condition for the join.
     * @param string|null $indexBy The index for the join.
     *
     * @return self
     */
    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null): self
    {
        $this->qb->leftJoin($join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    /**
     * Sets a new value for a field in a bulk update query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->update('User', 'u')
     *         ->set('u.password', '?1')
     *         ->where('u.id = ?2');
     * </code>
     *
     * @param string $key The key/field to set.
     * @param mixed $value The value, expression, placeholder, etc.
     *
     * @return self
     */
    public function set($key, $value): self
    {
        $this->qb->set($key, $value);
        return $this;
    }

    /**
     * Specifies one or more restrictions to the query result.
     * Replaces any previously specified restrictions, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = ?');
     *
     *     // You can optionally programmatically build and/or expressions
     *     $qb = $em->createQueryBuilder();
     *
     *     $or = $qb->expr()->orX();
     *     $or->add($qb->expr()->eq('u.id', 1));
     *     $or->add($qb->expr()->eq('u.id', 2));
     *
     *     $qb->update('User', 'u')
     *         ->set('u.password', '?')
     *         ->where($or);
     * </code>
     *
     * @param mixed $predicates The restriction predicates.
     *
     * @return self
     */
    public function where($predicates): self
    {
        $this->qb->where($predicates);
        return $this;
    }

    /**
     * Adds one or more restrictions to the query results, forming a logical
     * conjunction with any previously specified restrictions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.username LIKE ?')
     *         ->andWhere('u.is_active = 1');
     * </code>
     *
     * @param mixed $where The query restrictions.
     *
     * @return self
     *
     * @see where()
     */
    public function andWhere(): self
    {
        $args  = func_get_args();
        $where = $this->getDQLPart('where');

        if ($where instanceof Expr\Andx) {
            $where->addMultiple($args);
        } else {
            array_unshift($args, $where);
            $where = new Expr\Andx($args);
        }

        $this->add('where', $where);
        return $this;
    }

    /**
     * Adds one or more restrictions to the query results, forming a logical
     * disjunction with any previously specified restrictions.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->where('u.id = 1')
     *         ->orWhere('u.id = 2');
     * </code>
     *
     * @param mixed $where The WHERE statement.
     *
     * @return self
     *
     * @see where()
     */
    public function orWhere(): self
    {
        $this->qb->orWhere();
        return $this;
    }

    /**
     * Specifies a grouping over the results of the query.
     * Replaces any previously specified groupings, if any.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->groupBy('u.id');
     * </code>
     *
     * @param string $groupBy The grouping expression.
     *
     * @return self
     */
    public function groupBy($groupBy): self
    {
        $this->qb->groupBy($groupBy);
        return $this;
    }

    /**
     * Adds a grouping expression to the query.
     *
     * <code>
     *     $qb = $em->createQueryBuilder()
     *         ->select('u')
     *         ->from('User', 'u')
     *         ->groupBy('u.lastLogin')
     *         ->addGroupBy('u.createdAt');
     * </code>
     *
     * @param string $groupBy The grouping expression.
     *
     * @return self
     */
    public function addGroupBy($groupBy): self
    {
        $this->qb->addGroupBy($groupBy);
        return $this;
    }

    /**
     * Specifies a restriction over the groups of the query.
     * Replaces any previous having restrictions, if any.
     *
     * @param mixed $having The restriction over the groups.
     *
     * @return self
     */
    public function having($having): self
    {
        $this->qb->having($having);
        return $this;
    }

    /**
     * Adds a restriction over the groups of the query, forming a logical
     * conjunction with any existing having restrictions.
     *
     * @param mixed $having The restriction to append.
     *
     * @return self
     */
    public function andHaving($having): self
    {
        $this->qb->andHaving($having);
        return $this;
    }

    /**
     * Adds a restriction over the groups of the query, forming a logical
     * disjunction with any existing having restrictions.
     *
     * @param mixed $having The restriction to add.
     *
     * @return self
     */
    public function orHaving($having): self
    {
        $this->qb->orHaving($having);
        return $this;
    }

    /**
     * Specifies an ordering for the query results.
     * Replaces any previously specified orderings, if any.
     *
     * @param string|Expr\OrderBy $sort The ordering expression.
     * @param string $order The ordering direction.
     *
     * @return self
     */
    public function orderBy($sort, $order = null): self
    {
        $this->qb->orderBy($sort, $order);
        return $this;
    }

    /**
     * Adds an ordering to the query results.
     *
     * @param string|Expr\OrderBy $sort The ordering expression.
     * @param string $order The ordering direction.
     *
     * @return self
     */
    public function addOrderBy($sort, $order = null): self
    {
        $this->qb->addOrderBy($sort, $order);
        return $this;
    }

    /**
     * Adds criteria to the query.
     *
     * Adds where expressions with AND operator.
     * Adds orderings.
     * Overrides firstResult and maxResults if they're set.
     *
     * @param Criteria $criteria
     *
     * @return self
     *
     * @throws QueryException
     */
    public function addCriteria(Criteria $criteria): self
    {
        $this->qb->addCriteria($criteria);
        return $this;
    }

    /**
     * Gets a query part by its name.
     *
     * @param string $queryPartName
     *
     * @return mixed $queryPart
     *
     * @todo Rename: getQueryPart (or remove?)
     */
    public function getDQLPart($queryPartName)
    {
        return $this->qb->getDQLPart($queryPartName);
    }

    /**
     * Gets all query parts.
     *
     * @return array $dqlParts
     *
     * @todo Rename: getQueryParts (or remove?)
     */
    public function getDQLParts(): array
    {
        return $this->qb->getDQLParts();
    }

    /**
     * Resets DQL parts.
     *
     * @param array|null $parts
     *
     * @return self
     */
    public function resetDQLParts($parts = null): self
    {
        $this->qb->resetDQLParts($parts);
        return $this;
    }

    /**
     * Resets single DQL part.
     *
     * @param string $part
     *
     * @return self
     */
    public function resetDQLPart($part): self
    {
        $this->qb->resetDQLPart($part);
        return $this;
    }
}
