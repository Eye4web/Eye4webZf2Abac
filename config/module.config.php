<?php

return [
    'eye4web_abac' => [
        'assertion_manager' => [
            'factories' => [
                'page.view' => 'Application\Factory\Assertion\PageViewAssertionFactory',
            ]
        ]
    ],

    'doctrine' => [
        'driver' => [
            'abac_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => [
                    __DIR__ . '/../src/Eye4web/Zf2Abac/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Eye4web\Zf2Abac' => 'abac_driver'
                ]
            ]
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Eye4web\Zf2Abac\Service\AuthorizationService' => 'Eye4web\Zf2Abac\Factory\Service\AuthorizationServiceFactory',
            'Eye4web\Zf2Abac\Assertion\AssertionPluginManager' => 'Eye4web\Zf2Abac\Factory\Assertion\AssertionPluginManagerFactory',
            'Eye4web\Zf2Abac\Provider\DoctrineORMProvider' => 'Eye4web\Zf2Abac\Factory\Provider\DoctrineORMProviderFactory',
        ]
    ],

    'view_helpers' => [
        'factories' => [
            'hasPermission' => 'Eye4web\Zf2Abac\Factory\View\Helper\HasPermissionHelperFactory',
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            'hasPermission' => 'Eye4web\Zf2Abac\Factory\Mvc\Controller\Plugin\HasPermissionPluginFactory',
        ]
    ]
];
