<?php


namespace App\Util\Container;

use App\Entity\Fidelity\Users;

class User
{
    /**
     * @return Users|object|string|null
     */
    public static function get()
    {
        $token = TokenGuard::token();

        return ($token !== null) ? $token->getUser() : null;
    }
}
