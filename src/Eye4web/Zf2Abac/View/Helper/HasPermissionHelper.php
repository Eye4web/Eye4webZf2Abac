<?php

namespace Eye4web\Zf2Abac\View\Helper;

use Eye4web\Zf2Abac\Service\AuthorizationServiceInterface;
use Zend\View\Helper\AbstractHelper;

class HasPermission extends AbstractHelper
{
    /**
     * @var AuthorizationServiceInterface
     */
    private $authorizationService;

    /**
     * @param AuthorizationServiceInterface $authorizationService
     */
    public function __construct(AuthorizationServiceInterface $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }
}