<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AuthorityBindingType
{
    /**
     * @var QName
     */
    protected $AuthorityKind = null;

    /**
     * @var AnyURI
     */
    protected $Location = null;

    /**
     * @var AnyURI
     */
    protected $Binding = null;

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
     *
     * @return AuthorityBindingType
     */
    public function setAuthorityKind($AuthorityKind)
    {
        $this->AuthorityKind = $AuthorityKind;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getLocation()
    {
        return $this->Location;
    }

    /**
     * @param AnyURI $Location
     *
     * @return AuthorityBindingType
     */
    public function setLocation($Location)
    {
        $this->Location = $Location;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getBinding()
    {
        return $this->Binding;
    }

    /**
     * @param AnyURI $Binding
     *
     * @return AuthorityBindingType
     */
    public function setBinding($Binding)
    {
        $this->Binding = $Binding;

        return $this;
    }
}
