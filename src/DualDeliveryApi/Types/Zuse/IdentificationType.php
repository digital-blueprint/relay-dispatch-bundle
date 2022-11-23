<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\Zuse;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\stringentificationType;

class IdentificationType
{
    /**
     * @var Value
     */
    protected $Value = null;

    /**
     * @var AnyURI
     */
    protected $Type = null;

    /**
     * @var AnyURI
     */
    protected $Authority = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param Value  $Value
     * @param AnyURI $Type
     * @param AnyURI $Authority
     * @param string $any
     * @param string $Id
     */
    public function __construct($Value, $Type, $Authority, $any, $Id)
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

    /**
     * @return stringentificationType
     */
    public function setValue(Value $Value): self
    {
        $this->Value = $Value;

        return $this;
    }

    public function getType(): AnyURI
    {
        return $this->Type;
    }

    /**
     * @return stringentificationType
     */
    public function setType(AnyURI $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAuthority(): AnyURI
    {
        return $this->Authority;
    }

    /**
     * @return stringentificationType
     */
    public function setAuthority(AnyURI $Authority): self
    {
        $this->Authority = $Authority;

        return $this;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    /**
     * @return stringentificationType
     */
    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    /**
     * @return stringentificationType
     */
    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
