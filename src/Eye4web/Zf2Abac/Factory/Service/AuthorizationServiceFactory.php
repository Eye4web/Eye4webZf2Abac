<?php

namespace Eye4web\Zf2Abac\Factory\Service;

use Eye4web\Zf2Abac\Service\AuthorizationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthorizationServiceFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * Offer service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AuthorizationService
     */
    public function __invoke(\Interop\Container\ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /* @var \Eye4web\Zf2Abac\Assertion\AssertionPluginManager $assertionPluginManager */
        $assertionPluginManager = $serviceLocator->get('Eye4web\Zf2Abac\Assertion\AssertionPluginManager');

        return new AuthorizationService($assertionPluginManager);
    }
}
