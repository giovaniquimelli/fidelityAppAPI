<?php

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

function container_token_guard(): ?TokenInterface
{
    return container('security.token_storage')->getToken();
}

function container_token_guard_get(string $key, $default = null)
{
    $tokenGuard = container_token_guard();

    if ($tokenGuard !== null && $tokenGuard->hasAttribute($key)) {
        return $tokenGuard->getAttribute($key);
    }
    return $default;
}

function container_token_guard_set(string $key, $value)
{
    $tokenGuard = container_token_guard();
    if ($tokenGuard !== null) {
        return $tokenGuard->getAttribute($key);
    }
}
