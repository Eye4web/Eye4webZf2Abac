<?php

namespace Eye4web\Zf2Abac\Factory\Assertion;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Eye4web\Zf2Abac\Assertion\AssertionPluginManager;

class AssertionPluginManagerFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AssertionPluginManager
     */
    public function __invoke(\Interop\Container\ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /** @var array $config */
        $config = $serviceLocator->get('Config')['eye4web_abac']['assertion_manager'];

        $pluginManager = new AssertionPluginManager($serviceLocator, $config);
        //$pluginManager->setServiceLocator($serviceLocator);

        return $pluginManager;
    }
}
