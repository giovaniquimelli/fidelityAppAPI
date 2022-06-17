<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

function container_validator_validate($value, array $groups = [], $constraints = null): ConstraintViolationListInterface
{
    /** @var ValidatorInterface $validator */
    $validator = container('validator');

    return $validator->validate($value, $constraints, $groups);
}

if (function_exists('validator')) {
    function validator(): ValidatorInterface
    {
        return container('validator');
    }
}


