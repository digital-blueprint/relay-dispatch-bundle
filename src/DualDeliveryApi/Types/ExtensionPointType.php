<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ExtensionPointType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var AnyURI
     */
    protected $namespace = null;

    /**
     * @param string $any
     * @param AnyURI $namespace
     */
    public function __construct($any, $namespace)
    {
        $this->any = $any;
        $this->namespace = $namespace;
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

    public function getNamespace(): AnyURI
    {
        return $this->namespace;
    }

    public function setNamespace(AnyURI $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }
}
