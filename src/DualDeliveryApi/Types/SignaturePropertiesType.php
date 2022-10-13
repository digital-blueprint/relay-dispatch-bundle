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

    /**
     * @return SignaturePropertyType
     */
    public function getSignatureProperty()
    {
        return $this->SignatureProperty;
    }

    /**
     * @param SignaturePropertyType $SignatureProperty
     *
     * @return SignaturePropertiesType
     */
    public function setSignatureProperty($SignatureProperty)
    {
        $this->SignatureProperty = $SignatureProperty;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param string $Id
     *
     * @return SignaturePropertiesType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }
}
