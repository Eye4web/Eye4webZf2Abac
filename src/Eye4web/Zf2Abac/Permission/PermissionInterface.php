<?php

namespace Eye4web\Zf2Abac\Permission;

interface PermissionInterface
{
    /**
     * @param string $value
     * @param array $attributes
     * @return boolean
     */
    public function isValid($value, array $attributes);
}
