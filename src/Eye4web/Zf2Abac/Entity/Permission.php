<?php

namespace Eye4web\Zf2Abac\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="abac_permissions")
 */
class Permission implements PermissionInterface
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $value;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $valueId;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", length=18, nullable=true)
     */
    protected $group;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $validator;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $validatorOptions;

    public function __construct()
    {
        $this->name = null;
        $this->value = null;
        $this->valueId = null;
        $this->group = null;
        $this->validator = null;
        $this->validatorOptions = null;
    }

    /**
     * @param int|null $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return int|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null|string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null|string $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return null|string
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param string $validatorOptions
     */
    public function setValidatorOptions($validatorOptions)
    {
        $this->validatorOptions = $validatorOptions;
    }

    /**
     * @return string
     */
    public function getValidatorOptions()
    {
        return $this->validatorOptions;
    }

    /**
     * @param null|string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null|string $valueId
     */
    public function setValueId($valueId)
    {
        $this->valueId = $valueId;
    }

    /**
     * @return null|string
     */
    public function getValueId()
    {
        return $this->valueId;
    }
}
