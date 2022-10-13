<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ParameterType
{
    /**
     * @var string
     */
    protected $Property = null;

    /**
     * @var string
     */
    protected $Value = null;

    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @param string $Property
     */
    public function __construct($Property)
    {
        $this->Property = $Property;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->Property;
    }

    /**
     * @param string $Property
     *
     * @return ParameterType
     */
    public function setProperty($Property)
    {
        $this->Property = $Property;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param string $Value
     *
     * @return ParameterType
     */
    public function setValue($Value)
    {
        $this->Value = $Value;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     *
     * @return ParameterType
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}
