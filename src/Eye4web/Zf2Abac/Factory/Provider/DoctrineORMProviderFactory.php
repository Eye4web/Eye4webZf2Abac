<?php

namespace Eye4web\Zf2Abac\Factory\Provider;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Eye4web\Zf2Abac\Provider\DoctrineORMProvider;
use Doctrine\ORM\EntityManagerInterface;
use Zend\Validator\ValidatorPluginManager;

class DoctrineORMProviderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return DoctrineORMProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var EntityManagerInterface $objectManager */
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        /** @var ValidatorPluginManager $validatorPluginManager */
        $validatorPluginManager = $serviceLocator->get('ValidatorManager');

        return new DoctrineORMProvider($objectManager, $validatorPluginManager);
    }
}
