<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

class ActionType
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var AnyURI
     */
    protected $Namespace;

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
