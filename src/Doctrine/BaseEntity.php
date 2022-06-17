<?php


namespace App\Doctrine;

use App\Exception\ItemNotFoundException;
use App\Model\Base\QueryBuilderEx;
use App\Util\Arr;
use App\Util\Container\Serializer;
use App\Util\Str;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\ORMException;
use Ramsey\Uuid\Uuid;
use ReflectionException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

/**
 * Class BaseEntity - all entity helpers
 * @package App\Doctrine
 */
class BaseEntity
{
    /**
     * Return read groups
     * @param mixed $entityGroups Possible values 'min', 'entity', 'relations', relation_name(snake_case), 'blamable', 'timestampable', 'trash', 'id'
     * @param array $relationGroups
     * @return array|null
     */
    public static function gr($entityGroups = [], array $relationGroups = []): array
    {
        try {
            $basic_groups = ['min', 'entity', 'relations', 'blamable', 'timestampable', 'trash', 'id'];
            $_entityGroups = [];
            $entityName = Str::asSnakeCase((new \ReflectionClass(static::class))->getShortName());
            if (empty($entityGroups) && empty($relationGroups)) {
                return ["read-{$entityName}-min"];
            }
            if (is_string($entityGroups)) {
                $_entityGroups = [$entityGroups];
            } elseif (is_array($entityGroups)) {
                $_entityGroups = $entityGroups;
            }

            $allGroups = [];
            $autoRelationsGroups = [];
            $_relationGroups = Arr::flatten($relationGroups);

            foreach ($_entityGroups as $group) {
                if (!in_array($group, $basic_groups, true) && !static::isGroupInArray($_relationGroups, $group)) {
                    $_relationGroups[] = "read-{$group}-min";
                }
                if ($group !== 'entity') {
                    $allGroups[] = "read-{$entityName}-{$group}";
                    if ($group === 'blamable') {
                        $_relationGroups[] = 'blame';
                    }
                } else {
                    $allGroups[] = "read-{$entityName}";
                }
            }

            if (in_array("read-{$entityName}-relations", $allGroups, true)) {
                $autoRelationsGroups = static::getRelationsGroups();
            }

            $_autoRelationGroupsFiltered = [];
            foreach ($autoRelationsGroups as $agr) {
                $group = preg_replace('/^(read\-)([a-z_]{1,})(\-min)/i', '$2', $agr);
                if (!static::isGroupInArray($_relationGroups, $group)) {
                    $_autoRelationGroupsFiltered[] = $agr;
                }
            }


            return array_merge($allGroups, $_relationGroups, $_autoRelationGroupsFiltered);
        } catch (\ReflectionException $ex) {
            return [];
        }
    }

    public static function gw(array $entityGroups = []): array
    {
        $entityName = Str::asSnakeCase((new \ReflectionClass(static::class))->getShortName());
        $allGroups = [];
        if (!empty($entityGroups)) {
            foreach ($entityGroups as $group) {
                if ($group !== 'entity') {
                    $allGroups[] = "write-{$entityName}-{$group}";
                } else {
                    $allGroups[] = "write-{$entityName}";
                }
            }
        } else {
            $allGroups[] = "write-{$entityName}";
        }
        return $allGroups;
    }

    /**
     * @param $data
     * @param array $entityGroups
     * @param array $relationsGroups
     * @param array $context
     * @return array
     * @throws AnnotationException
     * @throws ExceptionInterface
     * @throws ReflectionException
     */
    public static function normalizeCollection($data, $entityGroups = [], array $relationsGroups = [], $context = []): array
    {
        return Serializer::normalizeCollection($data, static::gr($entityGroups, $relationsGroups), $context);
    }

    /**
     * @param $id
     * @return static::class
     */
    public static function ref($id): ?self
    {
        if ($id === null) {
            return null;
        }
        try {
            return db()->getReference(static::class, is_string($id) ? Uuid::fromString($id) : $id);
        } catch (ORMException $ex) {
            // log error
            return null;
        }
    }

    /**
     * @return array
     */
    private static function getRelationsGroups(): array
    {
        $relations = [];
        $skip_defaults = ['id', 'guid', 'createdBy', 'updatedBy', 'createdAt', 'updatedAt', 'deletedAt', 'statusCode'];

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metaData = $classMetadataFactory->getMetadataFor(static::class);
        $attrs = $metaData->getAttributesMetadata();
        foreach ($attrs as $attr) {
            $name = $attr->getName();
            if (!in_array($name, $skip_defaults)) {
                foreach ($attr->getGroups() as $group) {
                    if (strstr($group, 'relations') > -1 || strstr($group, 'fk') > -1) {
                        $relations[] = 'read-' . Str::asSnakeCase($name) . '-min';
                    }
                }
            }
        }
        return $relations;
    }

    /**
     * @param array $array
     * @param string $group
     * @return bool
     */
    private static function isGroupInArray(array $array, string $group): bool
    {
        $in_array = false;
        foreach ($array as $arr) {
            if (strpos($arr, "read-{$group}-") !== false || $arr === "read-{$group}") {
                $in_array = true;
                break;
            }
        }
        return $in_array;
    }

    /**
     * @param array $entityGroups
     * @param array $relationGroups
     * @param array $context
     * @return array|bool|float|int|mixed|object|string|null
     */
    public function normalize($entityGroups = [], array $relationGroups = [], $context = [])
    {
        try {
            return Serializer::normalize($this, static::gr($entityGroups, $relationGroups), $context);
        } catch (ExceptionInterface $e) {
            return null;
        }
    }

    /**
     * @param $groups
     * @param $context
     * @return string
     */
    public function serialize($groups, $context): string
    {
        return Serializer::serialize($this, $groups, 'json', $context);
    }
}
