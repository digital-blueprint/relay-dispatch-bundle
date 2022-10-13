<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AttributeType extends AttributeDesignatorType
{
    /**
     * @var mixed
     */
    protected $AttributeValue = null;

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
     *
     * @return AttributeType
     */
    public function setAttributeValue($AttributeValue)
    {
        $this->AttributeValue = $AttributeValue;

        return $this;
    }
}
