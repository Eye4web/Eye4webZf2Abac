<?php

namespace Eye4web\Zf2AbacTest\Provider;

use Doctrine\ORM\EntityManagerInterface;
use Eye4web\Zf2Abac\Provider\DoctrineORMProvider;
use PHPUnit_Framework_TestCase;
use Zend\Validator\ValidatorPluginManager;

class DoctrineORMProviderTest extends PHPUnit_Framework_TestCase
{
    /** @var DoctrineORMProvider */
    protected $provider;

    /** @var EntityManagerInterface */
    protected $objectManager;

    /** @var ValidatorPluginManager */
    protected $validatorPluginManager;

    public function setUp()
    {
        /** @var EntityManagerInterface $objectManager */
        $objectManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectManager = $objectManager;

        /** @var ValidatorPluginManager $validatorPluginManager */
        $validatorPluginManager = $this->getMock('Zend\Validator\ValidatorPluginManager');
        $this->validatorPluginManager = $validatorPluginManager;

        $provider = new DoctrineORMProvider($objectManager, $validatorPluginManager);
        $this->provider = $provider;
    }

    public function testGetPermission()
    {
        $name = "test";
        $value  = "test";
        $parameters = ['name' => $name, 'value' => $value];
        $permissions = ['a' => 'a', 'b' => 'b'];

        $query = $this->getMockBuilder('\Doctrine\ORM\AbstractQuery')
            ->setMethods(array('setParameters', 'getResult'))
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->objectManager->expects($this->once())
            ->method('createQuery')
            ->with('select p from \Eye4web\Zf2Abac\Entity\Permission p where p.name = :name and p.value = :value')
            ->willReturn($query);

        $query->expects($this->at(0))
            ->method('setParameters')
            ->with($parameters);

        $query->expects($this->at(1))
            ->method('getResult')
            ->willReturn($permissions);

        /** @var \Eye4web\Zf2Abac\Collections\PermissionCollection $result */
        $result = $this->provider->getPermissions($name, $value);

        $this->assertInstanceOf('Eye4web\Zf2Abac\Collections\PermissionCollection', $result);

        $this->assertTrue($result->contains('a'));
        $this->assertTrue($result->contains('b'));
    }

    public function testGetValidatorSuccess()
    {
        $validator = 'Zend\Validator\GreaterThan';
        $validatorMock = $this->getMockBuilder($validator)
            ->disableOriginalConstructor()
            ->getMock();

        $permission = $this->getMock('\Eye4web\Zf2Abac\Entity\Permission');

        $permission->expects($this->once())
            ->method('getValidator')
            ->willReturn($validator);

        $this->validatorPluginManager->expects($this->once())
            ->method('get')
            ->with($validator)
            ->willReturn($validatorMock);

        $permission->expects($this->once())
            ->method('getValidatorOptions')
            ->willReturn(null);

        $result = $this->provider->getValidator($permission);

        $this->assertInstanceOf('Zend\Validator\ValidatorInterface', $result);
    }

    public function testGetValidatorNoValidator()
    {
        $permission = $this->getMock('\Eye4web\Zf2Abac\Entity\Permission');

        $permission->expects($this->once())
            ->method('getValidator')
            ->willReturn(null);

        $this->setExpectedException('Eye4web\Zf2Abac\Exception\ValidatorNotFound');

        $this->provider->getValidator($permission);
    }

    public function testGetValidatorSuccessWithValidatorOptions()
    {
        $validator = 'Zend\Validator\GreaterThan';
        $validatorMock = $this->getMockBuilder($validator)
            ->disableOriginalConstructor()
            ->getMock();

        $options = '{"min": 10}';

        $permission = $this->getMock('\Eye4web\Zf2Abac\Entity\Permission');

        $permission->expects($this->once())
            ->method('getValidator')
            ->willReturn($validator);

        $this->validatorPluginManager->expects($this->once())
            ->method('get')
            ->with($validator)
            ->willReturn($validatorMock);

        $permission->expects($this->exactly(2))
            ->method('getValidatorOptions')
            ->willReturn($options);

        $validatorMock->expects($this->once())
            ->method('setOptions')
            ->with(json_decode($options, true));

        $result = $this->provider->getValidator($permission);

        $this->assertInstanceOf('Zend\Validator\ValidatorInterface', $result);
    }

    public function testGetValidatorIncorrectValidatorOptions()
    {
        $validator = 'Zend\Validator\GreaterThan';

        $validatorMock = $this->getMockBuilder($validator)
            ->disableOriginalConstructor()
            ->getMock();

        $permission = $this->getMock('\Eye4web\Zf2Abac\Entity\Permission');

        $permission->expects($this->once())
            ->method('getValidator')
            ->willReturn($validator);

        $this->validatorPluginManager->expects($this->once())
            ->method('get')
            ->with($validator)
            ->willReturn($validatorMock);

        $permission->expects($this->exactly(2))
            ->method('getValidatorOptions')
            ->willReturn('incorrect format');

        $this->setExpectedException('Eye4web\Zf2Abac\Exception\RuntimeException');

        $this->provider->getValidator($permission);
    }
}
