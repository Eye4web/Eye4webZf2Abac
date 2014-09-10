<?php

namespace Eye4web\Zf2AbacTest\Factory\Service;

use Eye4web\Zf2Abac\Factory\Service\AuthorizationServiceFactory;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthorizationServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var AuthorizationServiceFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new AuthorizationServiceFactory;
        $this->factory = $factory;
    }

    public function testCreateService()
    {
        $assertionPluginManager = $this->getMockBuilder('Eye4web\Zf2Abac\Assertion\AssertionPluginManager')
                                       ->disableOriginalConstructor()
                                       ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Eye4web\Zf2Abac\Assertion\AssertionPluginManager')
                             ->willReturn($assertionPluginManager);


        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\Zf2Abac\Service\AuthorizationService', $result);
    }
}
