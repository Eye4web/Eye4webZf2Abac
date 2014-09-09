<?php

namespace Eye4web\Zf2Abac\Assertion;

use Eye4web\Zf2Abac\Exception;
use Zend\ServiceManager\AbstractPluginManager;

class AssertionPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof AssertionInterface) {
            return;
        }

        throw new Exception\RunetimeException(sprintf(
            'Assertions must implement "Eye4web\Zf2Abac\Assertion\AssertionInterface", but "%s" was given',
            is_object($plugin) ? get_class($plugin) : gettype($plugin)
        ));
    }

    /**
     * {@inheritDoc}
     */
    protected function canonicalizeName($name)
    {
        return $name;
    }
}
