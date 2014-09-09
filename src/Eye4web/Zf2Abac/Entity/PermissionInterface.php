<?php

namespace Eye4web\Zf2Abac\Entity;

use Doctrine\ORM\Mapping as ORM;

interface PermissionInterface
{
    /**
     * @return null|string
     */
    public function getValueId();

    /**
     * @return int|null
     */
    public function getGroup();

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return null|string
     */
    public function getName();

    /**
     * @return null|string
     */
    public function getValidator();

    /**
     * @return null|string
     */
    public function getValidatorOptions();

    /**
     * @return null|string
     */
    public function getValue();
}
