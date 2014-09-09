<?php

return [
    'factories' => [
        'Eye4web\Zf2Abac\Service\AuthorizationService'      => 'Eye4web\Zf2Abac\Factory\Service\AuthorizationServiceFactory',
        'Eye4web\Zf2Abac\Assertion\AssertionPluginManager'  => 'Eye4web\Zf2Abac\Factory\Assertion\AssertionPluginManagerFactory',

        'Eye4web\Zf2Abac\Provider\DoctrineORMProvider'      => 'Eye4web\Zf2Abac\Factory\Provider\DoctrineORMProviderFactory',
    ]
];