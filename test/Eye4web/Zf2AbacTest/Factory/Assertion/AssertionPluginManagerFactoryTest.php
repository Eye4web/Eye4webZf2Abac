<?php

namespace ZfcRbacTest\Factory;

use Zend\ServiceManager\ServiceManager;
use Eye4web\Zf2Abac\Factory\Assertion\AssertionPluginManagerFactory;

/**
 * @covers \Eye4web\Zf2Abac\Factory\Assertion\AssertionPluginManagerFactory
 */
class AssertionPluginManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', [
            'eye4web_abac' => [
                'assertion_manager' => [],
            ]
        ]);

        $factory       = new AssertionPluginManagerFactory();
        $pluginManager = $factory->createService($serviceManager);

        $this->assertInstanceOf('Eye4web\Zf2Abac\Assertion\AssertionPluginManager', $pluginManager);
        $this->assertSame($serviceManager, $pluginManager);
    }
}
