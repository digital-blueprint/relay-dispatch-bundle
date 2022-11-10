<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Identification
{
    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @var string
     */
    protected $Value = null;

    /**
     * @param string $Type
     * @param string $Value
     */
    public function __construct($Type, $Value)
    {
        $this->Type = $Type;
        $this->Value = $Value;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    /**
     * @return stringentification
     */
    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getValue(): string
    {
        return $this->Value;
    }

    /**
     * @return stringentification
     */
    public function setValue(string $Value): self
    {
        $this->Value = $Value;

        return $this;
    }
}
