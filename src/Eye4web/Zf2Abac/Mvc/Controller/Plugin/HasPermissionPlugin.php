<?php

namespace Eye4web\Zf2Abac\Mvc\Controller\Plugin;

use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class HasPermissionPlugin extends AbstractPlugin
{
    /** @var AuthorizationServiceInterface */
    private $authorizationService;

    /**
     * @param AuthorizationServiceInterface $authorizationService
     */
    public function __construct(AuthorizationServiceInterface $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }

    /**
     * @param string $assertion
     * @param string $value
     * @param array $attributes
     * @return boolean
     */
    public function __invoke($assertion, $value, array $attributes = [])
    {
        return $this->authorizationService->hasPermission($assertion, $value, $attributes);
    }
}
