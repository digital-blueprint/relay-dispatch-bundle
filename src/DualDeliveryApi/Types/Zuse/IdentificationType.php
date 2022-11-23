<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

class IdentificationType
{
    /**
     * @var Value
     */
    protected $Value = null;

    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @var ?string
     */
    protected $Authority = null;

    /**
     * @var ?string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $Id = null;

    public function __construct(Value $Value, string $Type, ?string $Authority, ?string $any, string $Id)
    {
        $this->Value = $Value;
        $this->Type = $Type;
        $this->Authority = $Authority;
        $this->any = $any;
        $this->Id = $Id;
    }

    public function getValue(): Value
    {
        return $this->Value;
    }

    public function setValue(Value $Value): void
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

    public function getAuthority(): ?string
    {
        return $this->Authority;
    }

    public function setAuthority(string $Authority): void
    {
        $this->Authority = $Authority;
    }

    public function getAny(): ?string
    {
        return $this->any;
    }

    public function setAny(string $any): void
    {
        $this->any = $any;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): void
    {
        $this->Id = $Id;
    }
}
