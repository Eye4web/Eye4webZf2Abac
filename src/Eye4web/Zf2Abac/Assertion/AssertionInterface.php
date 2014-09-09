<?php

namespace Eye4web\Zf2Abac\Assertion;

interface AssertionInterface
{
    /**
     * @param string $value
     * @param array $attributes
     * @return boolean
     */
    public function hasPermission($value, array $attributes);
}
