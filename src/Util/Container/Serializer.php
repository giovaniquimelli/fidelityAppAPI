<?php


namespace App\Util\Container;


use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class Serializer
{
    /**
     * @var \Symfony\Component\Serializer\Serializer $serializer
     */
    public static $serializer;

    public static function init($serializer): void
    {
        static::$serializer = $serializer;
    }

    public static function serialize($data, array $groups = [], string $format = 'json', $context = []): string
    {
        if (empty($groups)) {
            return static::$serializer->serialize($data, $format);
        }
        $context['groups'] = $groups;

        // Error inside the serializer empties the final response. wtf
        return static::$serializer->serialize($data, $format, $context);
    }


    /**
     * Deserializes data into the given type.
     * @param $data
     * @param string $class
     * @param array $groups
     * @param string $format
     * @param array $context
     * @return array|object
     */
    public static function deserialize($data, string $class, array $groups = [], string $format = 'json', $context = [])
    {
        $context[AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT] = true;


        if (empty($groups)) {
            static::$serializer->deserialize($data, $class, $format, $context);
        }

        return static::$serializer->deserialize($data, $class, $format, array_merge(['groups' => $groups], $context));
    }

    /**
     * @param $collection
     * @param array $groups
     * @param array $context
     * @param null $format
     * @return array
     * @throws ExceptionInterface
     * @throws AnnotationException
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function normalizeCollection($collection, array $groups = [], $context = [], $format = null): array
    {
        if ($collection instanceof ArrayCollection) {
            $collection = $collection->getIterator()->getArrayCopy();
        }

        $normalizedCollection = [];

        foreach ($collection as $key => $value) {
            $normalizedCollection[$key] =  static::normalize($value, $groups, $context, $format);
        }
        return $normalizedCollection;
    }

    /**
     * @param $data
     * @param array $groups
     * @param array $context
     * @param null $format
     * @return array|bool|float|int|mixed|string|object
     * @throws ExceptionInterface
     */
    public static function normalize($data, array $groups = [], $context = [], $format = null)
    {
        // all callback parameters are optional (you can omit the ones you don't use)
        $maxDepthHandler = static function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            return null;
        };

        $genericCallbackArray = static function ($childObject, $parentObject, $attributeName, $normalizerFormat) {
            return [];
        };

        $circularReferenceHandler = static function ($object) {
            return null;
        };

        $defaultContext = [
            AbstractObjectNormalizer::SKIP_NULL_VALUES => false,
            AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true,
            AbstractObjectNormalizer::MAX_DEPTH_HANDLER => $maxDepthHandler,
            AbstractObjectNormalizer::ALLOW_EXTRA_ATTRIBUTES => true,
            AbstractObjectNormalizer::CIRCULAR_REFERENCE_LIMIT => 1,
            AbstractObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => $circularReferenceHandler
        ];

        if (count($groups) > 0) {
            $defaultContext[AbstractObjectNormalizer::GROUPS] = $groups;
        }
        $mergedContext = array_merge($defaultContext, $context);

        // dd($defaultContext);
        return static::$serializer->normalize($data, $format, $defaultContext);
    }

    /**
     * @param $data
     * @param $type
     * @param array $context
     * @return array|object
     * @throws ExceptionInterface
     */
    public static function denormalize($data, $type, $context = [])
    {

//    $defaultContext = [];
//    $defaultContext[AbstractObjectNormalizer::GROUPS] = $groups;
        $context[AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT] = true;

        return static::$serializer->denormalize($data, $type, null, $context);
    }

    /**
     * Denormalizes collection back into an object[] of the given class.
     * @param $collection
     * @param $type
     * @param array $context
     * @param null $format
     * @return array
     * @throws ExceptionInterface
     */
    public static function denormalizeCollection($collection, $type, $context = [], $format = null): array
    {
        /** @var \Symfony\Component\Serializer\Serializer $serializer */
        $serializer = container('serializer');

        $normalizedCollection = [];
        foreach ($collection as $key => $value) {
            $normalizedCollection[$key] = $serializer->denormalize($value, $type, null, $context);
        }
        return $normalizedCollection;
    }
}
