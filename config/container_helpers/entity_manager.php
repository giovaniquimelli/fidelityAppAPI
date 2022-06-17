<?php

use Doctrine\ORM\EntityManager;

/**
 * @return EntityManager
 */
function container_entity_manager(): EntityManager
{
    return container('doctrine.orm.default_entity_manager');
}

function db(): EntityManager
{
    return container_entity_manager();
}
