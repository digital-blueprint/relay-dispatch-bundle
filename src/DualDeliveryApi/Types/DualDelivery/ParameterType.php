<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ParameterType
{
    /**
     * @var string
     */
    protected $Property;

    /**
     * @var ?string
     */
    protected $Value;

    /**
     * @var ?string
     */
    protected $Type;

    public function __construct(string $Property, ?string $Value)
    {
        $this->Property = $Property;
        $this->Value = $Value;
    }

    public function getProperty(): string
    {
        return $this->Property;
    }

    public function setProperty(string $Property): void
    {
        $this->Property = $Property;
    }

    public function getValue(): ?string
    {
        return $this->Value;
    }

    public function setValue(string $Value): void
    {
        $this->Value = $Value;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): void
    {
        $this->Type = $Type;
    }
}
