<?php

namespace Eye4web\Zf2Abac\Provider;

use Eye4web\Zf2Abac\Collections\PermissionCollection;
use Eye4web\Zf2Abac\Entity\PermissionInterface;
use Zend\Validator\ValidatorInterface;

interface ProviderInterface
{
    /**
     * Get permissions from name and value
     *
     * @param string $name
     * @param string $value
     * @return array|PermissionCollection[]
     */
    public function getPermissions($name, $value);

    /**
     * Get validator from entity
     *
     * @param PermissionInterface $permission
     * @return ValidatorInterface
     */
    public function getValidator(PermissionInterface $permission);
}
