<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SignaturePropertyType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var AnyURI
     */
    protected $Target = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param string $any
     * @param AnyURI $Target
     * @param string $Id
     */
    public function __construct($any, $Target, $Id)
    {
        $this->any = $any;
        $this->Target = $Target;
        $this->Id = $Id;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getTarget(): AnyURI
    {
        return $this->Target;
    }

    public function setTarget(AnyURI $Target): self
    {
        $this->Target = $Target;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
