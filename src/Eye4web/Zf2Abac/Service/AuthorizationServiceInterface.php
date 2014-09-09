<?php

namespace Eye4web\Zf2Abac\Service;

interface AuthorizationServiceInterface
{
    /**
     * @param string $assertion
     * @param string $value
     * @param array $attributes
     * @return boolean
     */
    public function hasPermission($assertion, $value, array $attributes);
}
