# Introduction

## Attrbiute-Based Access Control

Abac stands for attribute-based access control. It represents a logical access control from simple access control lists to more capable role-based access, and also the very flexible methods for access control through different attributes.

## Example of use

For example, if you have a bulletin board, and wants to let users access different areas based on several attributes. That could for example be:

* Min. age
* User level (from - to)
* Specific sex
* Less than 3 warnings
* _and much more..._

Abac is great for purposes like this. The possibility to make assertions based on groups of permissions/attributes makes it very easy to customize and create permission groups suiting your needs.

---

# Providers

`Eye4web\Zf2Abac` uses providers to get permission groups. You're able to use ours or to create your own.

## Doctrine ORM

You can use the Doctrine ORM Provider to handle all permissions through your database.

### Database structure

The database scheme is located in `data/scheme.sql`

Table: `abac_permissions`

| id  | name | value | valueId   | group | validator   | validatorOptions |
|----:|------|-------|-----------|-------|-------------|------------------|
| 1   | page | index | blogPosts | 1     | GreaterThan | {"min": 300}     |

This is an example on how to create a permission. Here is the more detailed description:

* **name**: Name of the access group
* **value**: Specific access area
* **valueId**: This is what we are going to validate
* **group**: Permission group
* **validator**: Name of the validator <sup>1)</sup>
* **validatorOptions**: Options for the ``Zend\Validator`` in JSON-format <sup>2)</sup>

*1) See the full validator list here: [ZF2 Documentation: Standard Validation Classes](http://framework.zend.com/manual/2.2/en/modules/zend.validator.set.html)

*2) [JSON](http://en.wikipedia.org/wiki/JSON)

---

# Examples

## Assertion

### Writing your Assertion

This is an example on how to create a basic assertion.

#### Factory and providers

When creating an Assertion, you'll need to inject a provider implementing `Eye4web\Zf2Abac\Provider\ProviderInterface`. In this example we will be using `Eye4web\Zf2Abac\Provider\DoctrineORMProvider`.

```
<?php
namespace Application\Factory\Assertion;

use Application\Assertion\PageViewAssertion;
use Eye4web\Zf2Abac\Assertion\AssertionPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PageViewAssertionFactory implements FactoryInterface
{
    /**
     * Create Assertion
     *
     * @param ServiceLocatorInterface $assertionPluginManager
     * @return PageViewAssertion
     */
    public function createService (ServiceLocatorInterface $assertionPluginManager)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $assertionPluginManager->getServiceLocator();

        /** @var \Eye4web\Zf2Abac\Provider\DoctrineORMProvider $provider */
        $provider = $serviceLocator->get('Eye4web\Zf2Abac\Provider\DoctrineORMProvider');

        return new PageViewAssertion($provider);
    }
}
```

#### Assertion and validator

This assertion uses the built in `Zend\Validator` for value comparison.

```
<?php

namespace Application\Assertion;

use Eye4web\Zf2Abac\Assertion\AssertionInterface;
use Eye4web\Zf2Abac\Provider\ProviderInterface;
use Eye4web\Zf2Abac\Exception;
use Zend\Validator\ValidatorPluginManager;

class PageViewAssertion implements AssertionInterface
{
    /** @var ProviderInterface */
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function hasPermission($value, array $attributes)
    {
        $permissions = $this->provider->getPermissions('page', $value);

        /** @var \Eye4web\Zf2Abac\Entity\PermissionInterface $permission */
        foreach ($permissions as $permission) {
            $validator = $this->provider->getValidator($permission);

            if (!isset($attributes[$permission->getValueId()])) {
                throw new Exception\RuntimeException(sprintf(
                    'No value is set for permission with id %s',
                    $permission->getId()
                ));
            }

            if (!$validator->isValid($attributes[$permission->getValueId()])) {
                return false;
            }
        }

        return true;
    }
}
```

### Configuration

Now that you have created your Assertion, you'll need to add it in your configuration. The configuration can be placed in your `module.config.php` or by placing it in your `autoload` directory as following:

`config/autoload/zfc_abac.global.php`
```
<?php

return [
    'eye4web_abac' => [
        'assertion_manager' => [
            'factories' => [
                'page.view' => 'Application\Factory\Assertion\PageViewAssertionFactory',
            ]
        ]
    ],
];
```

## Plugins and helpers

Here are some examples on how to use the helper, plugin and injecting the service.

### Controller plugin

```
public function indexAction()
{
    $user = $this->identityProvider()->getIdentity();

    if (!$this->hasPermission('page.view', 'index', ['userLevel' => $user->getUserLevel()]) {
        throw new \Exception('You are not allowed to see this page');
    }
}
```

### View helper

```
<?php if (!$this->hasPermission('page.view', 'index', ['blogPosts' => count($posts)])) { ?>
    You need to have written at least 10 blog posts to enter this page.
<?php } ?>
```

### Inject into Service using the Service Locator

```
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Service
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Eye4web\Zf2Abac\Service\AuthorizationService $abacAuthorizationService */
        $abacAuthorizationService = $serviceLocator->get('Eye4web\Zf2Abac\Service\AuthorizationService');
    
        return new Service($abacAuthorizationService);
    }
```
