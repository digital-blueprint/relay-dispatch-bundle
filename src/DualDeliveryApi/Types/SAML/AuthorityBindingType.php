<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\QName;

class AuthorityBindingType
{
    /**
     * @var QName
     */
    protected $AuthorityKind;

    /**
     * @var AnyURI
     */
    protected $Location;

    /**
     * @var AnyURI
     */
    protected $Binding;

    /**
     * @param QName  $AuthorityKind
     * @param AnyURI $Location
     * @param AnyURI $Binding
     */
    public function __construct($AuthorityKind, $Location, $Binding)
    {
        $this->AuthorityKind = $AuthorityKind;
        $this->Location = $Location;
        $this->Binding = $Binding;
    }

    /**
     * @return QName
     */
    public function getAuthorityKind()
    {
        return $this->AuthorityKind;
    }

    /**
     * @param QName $AuthorityKind
     */
    public function setAuthorityKind($AuthorityKind): self
    {
        $this->AuthorityKind = $AuthorityKind;

        return $this;
    }

    public function getLocation(): AnyURI
    {
        return $this->Location;
    }

    public function setLocation(AnyURI $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getBinding(): AnyURI
    {
        return $this->Binding;
    }

    public function setBinding(AnyURI $Binding): self
    {
        $this->Binding = $Binding;

        return $this;
    }
}
