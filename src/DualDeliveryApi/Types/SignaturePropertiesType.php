<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class SignaturePropertiesType
{
    /**
     * @var SignaturePropertyType
     */
    protected $SignatureProperty = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @param SignaturePropertyType $SignatureProperty
     * @param string                $Id
     */
    public function __construct($SignatureProperty, $Id)
    {
        $this->SignatureProperty = $SignatureProperty;
        $this->Id = $Id;
    }

    public function getSignatureProperty(): SignaturePropertyType
    {
        return $this->SignatureProperty;
    }

    public function setSignatureProperty(SignaturePropertyType $SignatureProperty): self
    {
        $this->SignatureProperty = $SignatureProperty;

        return $this;
    }

    public function getId(): string
    {
        return $this->Id;
    }

    public function setId(string $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
}
