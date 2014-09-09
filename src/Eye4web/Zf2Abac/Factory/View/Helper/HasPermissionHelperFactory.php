<?php

namespace Eye4web\Zf2Abac\Factory\View\Helper;

use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Eye4web\Zf2Abac\View\Helper\HasPermissionHelper;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HasPermissionHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $pluginManager)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $pluginManager->getServiceLocator();

        /** @var AuthorizationServiceInterface $authorizationService */
        $authorizationService = $serviceLocator->get('Eye4web\Zf2Abac\Service\AuthorizationService');

        return new HasPermissionHelper($authorizationService);
    }
}
