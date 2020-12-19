<?php

namespace Eye4web\Zf2Abac\Factory\Mvc\Controller\Plugin;

use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Eye4web\Zf2Abac\Mvc\Controller\Plugin\HasPermissionPlugin;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HasPermissionPluginFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $pluginManager, $requestedName, array $options = null)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $pluginManager->getServiceLocator();

        /** @var AuthorizationServiceInterface $authorizationService */
        $authorizationService = $serviceLocator->get('Eye4web\Zf2Abac\Service\AuthorizationService');

        return new HasPermissionPlugin($authorizationService);
    }
}
