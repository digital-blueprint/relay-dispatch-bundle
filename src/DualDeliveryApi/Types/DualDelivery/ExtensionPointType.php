<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ExtensionPointType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $namespace = null;

    public function __construct(string $any, string $namespace)
    {
        $this->any = $any;
        $this->namespace = $namespace;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): void
    {
        $this->any = $any;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }
}
