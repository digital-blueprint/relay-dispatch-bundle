<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData;

class IdentificationType
{
    /**
     * @var string
     */
    protected $Value = null;

    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @var ?string
     */
    protected $Id = null;

    public function __construct(string $Value, string $Type, string $Id = null)
    {
        $this->Value = $Value;
        $this->Type = $Type;
        $this->Id = $Id;
    }

    public function getValue(): string
    {
        return $this->Value;
    }

    public function setValue(string $Value): void
    {
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

    public function getId(): ?string
    {
        return $this->Id;
    }

    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }
}
