<?php

namespace Eye4web\Zf2AbacTest\Factory\View\Helper;

use Eye4web\Zf2Abac\Factory\View\Helper\HasPermissionHelperFactory;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class HasPermissionHelperFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var HasPermissionHelperFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $pluginManager;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $pluginManager = $this->getMock('Zend\Mvc\Controller\PluginManager');
        $this->pluginManager = $pluginManager;

        $factory = new HasPermissionHelperFactory;
        $this->factory = $factory;
    }

    public function testCreateService()
    {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $this->pluginManager->expects($this->once())
                             ->method('getServiceLocator')
                             ->willReturn($serviceLocator);

        $authorizationService = $this->getMock('Eye4web\Zf2Abac\Service\AuthorizationServiceInterface');

        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with('Eye4web\Zf2Abac\Service\AuthorizationService')
                       ->willReturn($authorizationService);


        $result = $this->factory->createService($this->pluginManager);

        $this->assertInstanceOf('Eye4web\Zf2Abac\View\Helper\HasPermissionHelper', $result);
    }
}
