<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\QName;

class AuthorityBindingType
{
    /**
     * @var QName
     */
    protected $AuthorityKind;

    /**
     * @var string
     */
    protected $Location;

    /**
     * @var string
     */
    protected $Binding;

    /**
     * @param QName  $AuthorityKind
     * @param string $Location
     * @param string $Binding
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

    public function getLocation(): string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getBinding(): string
    {
        return $this->Binding;
    }

    public function setBinding(string $Binding): self
    {
        $this->Binding = $Binding;

        return $this;
    }
}
