<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PayloadType
{
    /**
     * @var PayloadAttributesType
     */
    protected $PayloadAttributes;

    /**
     * @var DocumentType
     */
    protected $Document;

    public function __construct(PayloadAttributesType $PayloadAttributes, DocumentType $Document)
    {
        $this->PayloadAttributes = $PayloadAttributes;
        $this->Document = $Document;
    }

    public function getPayloadAttributes(): PayloadAttributesType
    {
        return $this->PayloadAttributes;
    }

    public function setPayloadAttributes(PayloadAttributesType $PayloadAttributes): void
    {
        $this->PayloadAttributes = $PayloadAttributes;
    }

    public function getDocument(): DocumentType
    {
        return $this->Document;
    }

    public function setDocument(DocumentType $Document): void
    {
        $this->Document = $Document;
    }
}
