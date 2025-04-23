<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class SignaturePropertyType
{
    /**
     * @var string
     */
    protected $any;

    /**
     * @var string
     */
    protected $Target;

    /**
     * @var string
     */
    protected $Id;

    /**
     * @param string $any
     * @param string $Target
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

    public function getTarget(): string
    {
        return $this->Target;
    }

    public function setTarget(string $Target): self
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
