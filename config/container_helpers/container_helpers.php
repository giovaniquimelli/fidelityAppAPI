<?php

/**
 * @param string|null $container
 * @return object|\Symfony\Component\DependencyInjection\ContainerInterface|null
 */
function container(string $container = null)
{
    global $kernel;
    if($container === null) {
        return $kernel->getContainer();
    }
    return $kernel->getContainer()->get($container);
}

require_once 'entity_manager.php';
require_once 'parameter.php';
require_once 'serializer.php';
require_once 'token_guard.php';
require_once 'users.php';
require_once 'validator.php';
