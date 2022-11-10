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

    public function getPayloadAttributes(): PayloadAttributesType
    {
        return $this->PayloadAttributes;
    }

    public function setPayloadAttributes(PayloadAttributesType $PayloadAttributes): self
    {
        $this->PayloadAttributes = $PayloadAttributes;

        return $this;
    }

    public function getDocument(): DocumentType
    {
        return $this->Document;
    }

    public function setDocument(DocumentType $Document): self
    {
        $this->Document = $Document;

        return $this;
    }
}
