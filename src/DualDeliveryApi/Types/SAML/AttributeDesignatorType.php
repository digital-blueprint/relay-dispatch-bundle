<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

class AttributeDesignatorType
{
    /**
     * @var string
     */
    protected $AttributeName;

    /**
     * @var AnyURI
     */
    protected $AttributeNamespace;

    /**
     * @param string $AttributeName
     * @param AnyURI $AttributeNamespace
     */
    public function __construct($AttributeName, $AttributeNamespace)
    {
        $this->AttributeName = $AttributeName;
        $this->AttributeNamespace = $AttributeNamespace;
    }

    public function getAttributeName(): string
    {
        return $this->AttributeName;
    }

    public function setAttributeName(string $AttributeName): self
    {
        $this->AttributeName = $AttributeName;

        return $this;
    }

    public function getAttributeNamespace(): AnyURI
    {
        return $this->AttributeNamespace;
    }

    public function setAttributeNamespace(AnyURI $AttributeNamespace): self
    {
        $this->AttributeNamespace = $AttributeNamespace;

        return $this;
    }
}
