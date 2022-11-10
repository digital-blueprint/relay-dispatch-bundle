<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ActionType
{
    /**
     * @var string
     */
    protected $_ = null;

    /**
     * @var AnyURI
     */
    protected $Namespace = null;

    /**
     * @param string $_
     * @param AnyURI $Namespace
     */
    public function __construct($_, $Namespace)
    {
        $this->_ = $_;
        $this->Namespace = $Namespace;
    }

    public function get_(): string
    {
        return $this->_;
    }

    public function set_(string $_): self
    {
        $this->_ = $_;

        return $this;
    }

    public function getNamespace(): AnyURI
    {
        return $this->Namespace;
    }

    public function setNamespace(AnyURI $Namespace): self
    {
        $this->Namespace = $Namespace;

        return $this;
    }
}
