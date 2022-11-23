<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

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

    public function __construct(string $Type, string $Value)
    {
        $this->Type = $Type;
        $this->Value = $Value;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): void
    {
        $this->Type = $Type;
    }

    public function getValue(): string
    {
        return $this->Value;
    }

    public function setValue(string $Value): void
    {
        $this->Value = $Value;
    }
}
