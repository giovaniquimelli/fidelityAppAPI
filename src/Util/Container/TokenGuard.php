<?php


namespace App\Util\Container;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class TokenGuard
{
    public static function token(): ?TokenInterface
    {
        /** @var TokenStorage|null $token */
        $token = ContainerService::get('security.token_storage');

        if($token === null) {
            return null;
        }

        return $token->getToken();
    }

    public static function get(string $key, $default = null)
    {
        $tokenGuard = static::token();

        if ($tokenGuard !== null && $tokenGuard->hasAttribute($key)) {
            return $tokenGuard->getAttribute($key);
        }
        return $default;
    }

    public static function set(string $key, $value)
    {
        $tokenGuard = static::token();
        if ($tokenGuard !== null) {
            return $tokenGuard->getAttribute($key);
        }
        return null;
    }
}
