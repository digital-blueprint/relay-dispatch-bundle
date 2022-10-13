<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PayloadType
{
    /**
     * @var PayloadAttributesType
     */
    protected $PayloadAttributes = null;

    /**
     * @var DocumentType
     */
    protected $Document = null;

    /**
     * @param PayloadAttributesType $PayloadAttributes
     * @param DocumentType          $Document
     */
    public function __construct($PayloadAttributes, $Document)
    {
        $this->PayloadAttributes = $PayloadAttributes;
        $this->Document = $Document;
    }

    /**
     * @return PayloadAttributesType
     */
    public function getPayloadAttributes()
    {
        return $this->PayloadAttributes;
    }

    /**
     * @param PayloadAttributesType $PayloadAttributes
     *
     * @return PayloadType
     */
    public function setPayloadAttributes($PayloadAttributes)
    {
        $this->PayloadAttributes = $PayloadAttributes;

        return $this;
    }

    /**
     * @return DocumentType
     */
    public function getDocument()
    {
        return $this->Document;
    }

    /**
     * @param DocumentType $Document
     *
     * @return PayloadType
     */
    public function setDocument($Document)
    {
        $this->Document = $Document;

        return $this;
    }
}
