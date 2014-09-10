<?php

namespace Eye4web\Zf2AbacTest\Mvc\Controller\Plugin;

use Eye4web\Zf2Abac\Mvc\Controller\Plugin\HasPermissionPlugin;
use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;

class HasPermissionPluginTest extends PHPUnit_Framework_TestCase
{
    /** @var HasPermissionPlugin */
    protected $plugin;

    /** @var AuthorizationServiceInterface */
    protected $authorizationService;

    public function setUp()
    {
        /** @var AuthorizationServiceInterface $authorizationService */
        $authorizationService = $this->getMock('Eye4web\Zf2Abac\Service\AuthorizationServiceInterface');
        $this->authorizationService = $authorizationService;

        $plugin = new HasPermissionPlugin($authorizationService);
        $this->plugin = $plugin;
    }

    public function testInvoke()
    {
        $assertion = 'assertion';
        $value = 'value';
        $attributes = [
            'key' => 'value'
        ];

        $this->authorizationService->expects($this->once())
                                   ->method('hasPermission')
                                   ->with($assertion, $value, $attributes)
                                   ->willReturn(true);

        $result = $this->plugin->__invoke($assertion, $value, $attributes);

        $this->assertTrue($result);
    }
}
