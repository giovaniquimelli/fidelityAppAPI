<?php


namespace App\Util\Container;


use App\Doctrine\DB;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerService
{
    /**
     * @var object|ContainerInterface|null
     */
    private static $container = null;

    /**
     * Do not use. Called once in ContainerService::init()
     * @param $container
     */
    public static function init($container)
    {
        // var_dump($container);
        static::$container = $container;
        Serializer::init(static::get('serializer'));
    }

    /**
     * @param $container
     * @return object|ContainerInterface|null
     */
    public static function get(?string $container = null)
    {
        if($container === null) {
            return static::$container;
        }
        return static::$container->get($container);
    }

    public static function param(string $name)
    {
        return static::$container->getParameter($name);
    }

    /**
     * @return EntityManager|object|null
     */
    public static function em()
    {
        return static::$container->get('doctrine.orm.default_entity_manager');
    }

}
