<?php

use App\Entity\Fidelity\Users;

/**
 * @return Users|null
 */
function container_user(): ?Users
{
    $token = container_token_guard();

    return ($token !== null) ? $token->getUser() : null;
}

function container_user_reference(int $id): Users
{
    return container_entity_manager()->getReference(Users::class, $id);
}

