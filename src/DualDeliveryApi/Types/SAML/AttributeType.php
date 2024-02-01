<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\SAML;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

class AttributeType extends AttributeDesignatorType
{
    /**
     * @var mixed
     */
    protected $AttributeValue;

    /**
     * @param string $AttributeName
     * @param AnyURI $AttributeNamespace
     * @param mixed  $AttributeValue
     */
    public function __construct($AttributeName, $AttributeNamespace, $AttributeValue)
    {
        parent::__construct($AttributeName, $AttributeNamespace);
        $this->AttributeValue = $AttributeValue;
    }

    /**
     * @return mixed
     */
    public function getAttributeValue()
    {
        return $this->AttributeValue;
    }

    /**
     * @param mixed $AttributeValue
     */
    public function setAttributeValue($AttributeValue): self
    {
        $this->AttributeValue = $AttributeValue;

        return $this;
    }
}
