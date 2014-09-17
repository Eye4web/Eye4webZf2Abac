<?php

namespace Eye4web\Zf2AbacTest\Service;

use Eye4web\Zf2Abac\Service\AuthorizationService;
use PHPUnit_Framework_TestCase;
use Eye4web\Zf2Abac\Assertion\AssertionPluginManager;
use Zend\Validator\ValidatorPluginManager;

class AuthorizationServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var AuthorizationService */
    protected $service;
    
    /** @var AssertionPluginManager */
    protected $assertionPluginManager;

    public function setUp()
    {
        /** @var AssertionPluginManager $assertionPluginManager */
        $assertionPluginManager = $this->getMockBuilder('Eye4web\Zf2Abac\Assertion\AssertionPluginManager')
                                       ->disableOriginalConstructor()
                                       ->getMock();


        $this->assertionPluginManager = $assertionPluginManager;

        $this->service = new AuthorizationService($assertionPluginManager);
    }

    public function testHasPermissionNoAssertion()
    {
        $assertionName = 'assertion';
        $value = 'value';
        $attributes = [
            'key' => 'value'
        ];

        $this->assertionPluginManager->expects($this->once())
            ->method('get')
            ->with($assertionName)
            ->willReturn(null);

        $this->setExpectedException('Eye4web\Zf2Abac\Exception\AssertionNotFound');

        $this->service->hasPermission($assertionName, $value, $attributes);
    }

    public function testHasPermissionSuccess()
    {
        $assertionName = 'assertion';
        $value = 'value';
        $attributes = [
            'key' => 'value'
        ];

        $assertion = $this->getMock('Eye4web\Zf2Abac\Assertion\AssertionInterface');

        $this->assertionPluginManager->expects($this->once())
            ->method('get')
            ->with($assertionName)
            ->willReturn($assertion);

        $assertion->expects($this->once())
            ->method('hasPermission')
            ->with($value, $attributes)
            ->willReturn(true);

        $result = $this->service->hasPermission($assertionName, $value, $attributes);

        $this->assertTrue($result);
    }
}
