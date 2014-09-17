<?php

namespace Eye4web\Zf2AbacTest\Factory\Provider;

use Eye4web\Zf2Abac\Factory\Provider\DoctrineORMProviderFactory;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineORMProviderFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var DoctrineORMProviderFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new DoctrineORMProviderFactory;
        $this->factory = $factory;
    }

    public function testCreateService()
    {
        $entityManager = $this->getMock('Doctrine\ORM\EntityManagerInterface');

        $this->serviceLocator->expects($this->at(0))
            ->method('get')
            ->with('Doctrine\ORM\EntityManager')
            ->willReturn($entityManager);

        $validatorManager = $this->getMock('Zend\Validator\ValidatorPluginManager');

        $this->serviceLocator->expects($this->at(1))
            ->method('get')
            ->with('ValidatorManager')
            ->willReturn($validatorManager);


        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\Zf2Abac\Provider\ProviderInterface', $result);
    }
}
