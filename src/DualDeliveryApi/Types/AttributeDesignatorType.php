<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AttributeDesignatorType
{
    /**
     * @var string
     */
    protected $AttributeName = null;

    /**
     * @var AnyURI
     */
    protected $AttributeNamespace = null;

    /**
     * @param string $AttributeName
     * @param AnyURI $AttributeNamespace
     */
    public function __construct($AttributeName, $AttributeNamespace)
    {
        $this->AttributeName = $AttributeName;
        $this->AttributeNamespace = $AttributeNamespace;
    }

    /**
     * @return string
     */
    public function getAttributeName()
    {
        return $this->AttributeName;
    }

    /**
     * @param string $AttributeName
     *
     * @return AttributeDesignatorType
     */
    public function setAttributeName($AttributeName)
    {
        $this->AttributeName = $AttributeName;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAttributeNamespace()
    {
        return $this->AttributeNamespace;
    }

    /**
     * @param AnyURI $AttributeNamespace
     *
     * @return AttributeDesignatorType
     */
    public function setAttributeNamespace($AttributeNamespace)
    {
        $this->AttributeNamespace = $AttributeNamespace;

        return $this;
    }
}
