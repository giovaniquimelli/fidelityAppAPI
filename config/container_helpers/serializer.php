<?php

use App\Entity\Users;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

// TODO: build a custom serializer/deserializer/normalizer/denormalizer with custom types
// Datetime: Y-m-d H:i:s
// Datetime: Y-m-d H:i
// Date: Y-m-d

function container_serializer_serialize($data, array $groups = [], string $format = 'json', $context = [])
{
    /** @var \Symfony\Component\Serializer\Serializer $serializer */
    $serializer = container('serializer');

    if (empty($groups)) {
        return $serializer->serialize($data, $format);
    }

    return $serializer->serialize($data, $format, ['groups' => $groups]);
}


function container_serializer_deserialize($data, string $class, array $groups = [], string $format = 'json', $context = [])
{
    /** @var Serializer $serializer */
    $serializer = container('serializer');

    $context[AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT] = true;



    if (empty($groups)) {
        $serializer->deserialize($data, $class, $format, $context);
    }

    return $serializer->deserialize($data, $class, $format, array_merge(['groups' => $groups], $context));
}

function container_serializer_normalize_collection($collection, array $groups = [], $context = [], $format = null)
{
    if($collection instanceof \Doctrine\Common\Collections\ArrayCollection) {
        $collection = $collection->getIterator()->getArrayCopy();
    }

    $normalizedCollection = [];

    foreach ($collection as $key => $value) {
        $normalizedCollection[$key] = container_serializer_normalize($value, $groups, $context, $format);
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
 * @throws ReflectionException
 * @throws \Doctrine\Common\Annotations\AnnotationException
 */
function container_serializer_normalize($data, array $groups = [], $context = [], $format = null)
{
    /** @var Symfony\Component\Serializer\Serializer $serializer */
    $serializer = container('serializer');

    // all callback parameters are optional (you can omit the ones you don't use)
    $maxDepthHandler = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
        return null;
    };

    $genericCallbackArray = function ($childObject, $parentObject, $attributeName, $normalizerFormat) {
        return [];
    };

    $circularReferenceHandler = function ($object) {
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

    return $serializer->normalize($data, null, $defaultContext);
}

function container_serializer_denormalize($data, $type, $context = [])
{
    /** @var \Symfony\Component\Serializer\Serializer $serializer */
    $serializer = container('serializer');

//    $defaultContext = [];
//    $defaultContext[AbstractObjectNormalizer::GROUPS] = $groups;
    $context[AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT] = true;

    return $serializer->denormalize($data, $type, null, $context);
}

function container_serializer_denormalize_collection($collection, $type, $context = [], $format = null)
{
    /** @var \Symfony\Component\Serializer\Serializer $serializer */
    $serializer = container('serializer');

    $normalizedCollection = [];
    foreach ($collection as $key => $value) {
        $normalizedCollection[$key] = $serializer->denormalize($value, $type, null, $context);
    }
    return $normalizedCollection;
}
