<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class CustomType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @param string $any
     */
    public function __construct($any)
    {
        $this->any = $any;
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
}
