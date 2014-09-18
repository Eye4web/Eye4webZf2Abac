

## Plugins and helpers

Here are some examples on how to use the helper, plugin and injecting the service.

### Controller plugin

The Controller Plugin follows the syntax `$this->hasParmission($name, $value, array $attributes)`

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

The View Helper follows the syntax `$this->hasParmission($name, $value, array $attributes)`

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