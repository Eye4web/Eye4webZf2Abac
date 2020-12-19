<?php

namespace Eye4web\Zf2Abac\Factory\Provider;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Eye4web\Zf2Abac\Provider\DoctrineORMProvider;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Validator\ValidatorPluginManager;

class DoctrineORMProviderFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return DoctrineORMProvider
     */
    public function __invoke(\Interop\Container\ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /** @var EntityManagerInterface $objectManager */
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        /** @var ValidatorPluginManager $validatorPluginManager */
        $validatorPluginManager = $serviceLocator->get('ValidatorManager');

        return new DoctrineORMProvider($objectManager, $validatorPluginManager);
    }
}
