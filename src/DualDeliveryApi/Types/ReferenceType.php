<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReferenceType
{
    /**
     * @var TransformsType
     */
    protected $Transforms = null;

    /**
     * @var DigestMethodType
     */
    protected $DigestMethod = null;

    /**
     * @var DigestValueType
     */
    protected $DigestValue = null;

    /**
     * @var string
     */
    protected $Id = null;

    /**
     * @var AnyURI
     */
    protected $URI = null;

    /**
     * @var AnyURI
     */
    protected $Type = null;

    /**
     * @param TransformsType   $Transforms
     * @param DigestMethodType $DigestMethod
     * @param DigestValueType  $DigestValue
     * @param string           $Id
     * @param AnyURI           $URI
     * @param AnyURI           $Type
     */
    public function __construct($Transforms, $DigestMethod, $DigestValue, $Id, $URI, $Type)
    {
        $this->Transforms = $Transforms;
        $this->DigestMethod = $DigestMethod;
        $this->DigestValue = $DigestValue;
        $this->Id = $Id;
        $this->URI = $URI;
        $this->Type = $Type;
    }

    /**
     * @return TransformsType
     */
    public function getTransforms()
    {
        return $this->Transforms;
    }

    /**
     * @param TransformsType $Transforms
     *
     * @return ReferenceType
     */
    public function setTransforms($Transforms)
    {
        $this->Transforms = $Transforms;

        return $this;
    }

    /**
     * @return DigestMethodType
     */
    public function getDigestMethod()
    {
        return $this->DigestMethod;
    }

    /**
     * @param DigestMethodType $DigestMethod
     *
     * @return ReferenceType
     */
    public function setDigestMethod($DigestMethod)
    {
        $this->DigestMethod = $DigestMethod;

        return $this;
    }

    /**
     * @return DigestValueType
     */
    public function getDigestValue()
    {
        return $this->DigestValue;
    }

    /**
     * @param DigestValueType $DigestValue
     *
     * @return ReferenceType
     */
    public function setDigestValue($DigestValue)
    {
        $this->DigestValue = $DigestValue;

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
     * @return ReferenceType
     */
    public function setId($Id)
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getURI()
    {
        return $this->URI;
    }

    /**
     * @param AnyURI $URI
     *
     * @return ReferenceType
     */
    public function setURI($URI)
    {
        $this->URI = $URI;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param AnyURI $Type
     *
     * @return ReferenceType
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}
