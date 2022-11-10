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
    public function __construct($Property, $Value)
    {
        $this->Property = $Property;
        $this->Value = $Value;
    }

    public function getProperty(): string
    {
        return $this->Property;
    }

    public function setProperty(string $Property): self
    {
        $this->Property = $Property;

        return $this;
    }

    public function getValue(): string
    {
        return $this->Value;
    }

    public function setValue(string $Value): self
    {
        $this->Value = $Value;

        return $this;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
