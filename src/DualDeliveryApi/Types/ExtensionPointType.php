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

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return ExtensionPointType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param AnyURI $namespace
     *
     * @return ExtensionPointType
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
