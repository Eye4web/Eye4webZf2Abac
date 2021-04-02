<?php

namespace Eye4web\Zf2Abac\Service;

use Eye4web\Zf2Abac\Exception;
use Eye4web\Zf2Abac\Assertion\AssertionPluginManager;

class AuthorizationService implements AuthorizationServiceInterface
{
    /** @var AssertionPluginManager */
    protected $assertionPluginManager;

    public function __construct(AssertionPluginManager $assertionPluginManager)
    {
        $this->assertionPluginManager = $assertionPluginManager;
    }

    /**
     * Check assertion for permissions
     *
     * @param string $assertionName
     * @param string $value
     * @param array $attributes
     * @return bool
     * @throws \Eye4web\Zf2Abac\Exception\AssertionNotFound
     */
    public function hasPermission($assertionName, $value, array $attributes)
    {
        /** @var \Eye4web\Zf2Abac\Assertion\AssertionInterface $assertion */
        $assertion = $this->assertionPluginManager->get($assertionName);

        if (!$assertion) {
            throw new Exception\AssertionNotFound(sprintf(
                'The assertion \"%s\" was not found',
                is_object($assertion) ? $assertion::class : gettype($assertion)
            ));
        }

        return $assertion->hasPermission($value, $attributes);
    }
}
