<?php

namespace Eye4web\Zf2AbacTest\View\Helper;

use Eye4web\Zf2Abac\View\Helper\HasPermissionHelper;
use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;

class HasPermissionHelperTest extends PHPUnit_Framework_TestCase
{
    /** @var HasPermissionHelper */
    protected $plugin;

    /** @var AuthorizationServiceInterface */
    protected $authorizationService;

    public function setUp()
    {
        /** @var AuthorizationServiceInterface $authorizationService */
        $authorizationService = $this->getMock('Eye4web\Zf2Abac\Service\AuthorizationServiceInterface');
        $this->authorizationService = $authorizationService;

        $helper = new HasPermissionHelper($authorizationService);
        $this->helper = $helper;
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

        $result = $this->helper->__invoke($assertion, $value, $attributes);

        $this->assertTrue($result);
    }
}
