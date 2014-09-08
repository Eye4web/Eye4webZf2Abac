<?php

namespace Eye4web\Zf2Abac\Service;

class AuthorizationService implements AuthorizationServiceInterface
{
    protected $assertionPluginManager;

    /** @var array */
    protected $assertions = [];

    public function __construct()
    {

    }

    public function hasPermission($type, $typeId)
    {

    }
}