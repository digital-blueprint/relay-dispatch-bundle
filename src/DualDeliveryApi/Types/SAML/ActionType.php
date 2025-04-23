<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class ActionType
{
    /**
     * @var string
     */
    protected $_;

    /**
     * @var string
     */
    protected $Namespace;

    /**
     * @param string $_
     * @param string $Namespace
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

    public function getNamespace(): string
    {
        return $this->Namespace;
    }

    public function setNamespace(string $Namespace): self
    {
        $this->Namespace = $Namespace;

        return $this;
    }
}
