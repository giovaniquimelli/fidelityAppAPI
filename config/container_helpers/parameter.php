<?php

function container_param_get(string $key, $default = null)
{
    //global $kernel;
    //$aki = $kernel->getContainer()->getParameter($key);
    return container()->getParameter($key);
}
