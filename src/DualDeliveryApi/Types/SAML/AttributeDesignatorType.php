<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

class AttributeDesignatorType
{
    /**
     * @var string
     */
    protected $AttributeName;

    /**
     * @var string
     */
    protected $AttributeNamespace;

    /**
     * @param string $AttributeName
     * @param string $AttributeNamespace
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

    public function getAttributeNamespace(): string
    {
        return $this->AttributeNamespace;
    }

    public function setAttributeNamespace(string $AttributeNamespace): self
    {
        $this->AttributeNamespace = $AttributeNamespace;

        return $this;
    }
}
