<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;
use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DigestValueType;

class ReferenceType
{
    /**
     * @var TransformsType
     */
    protected $Transforms;

    /**
     * @var DigestMethodType
     */
    protected $DigestMethod;

    /**
     * @var DigestValueType
     */
    protected $DigestValue;

    /**
     * @var string
     */
    protected $Id;

    /**
     * @var AnyURI
     */
    protected $URI;

    /**
     * @var AnyURI
     */
    protected $Type;

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

    public function getTransforms(): TransformsType
    {
        return $this->Transforms;
    }

    public function setTransforms(TransformsType $Transforms): self
    {
        $this->Transforms = $Transforms;

        return $this;
    }

    public function getDigestMethod(): DigestMethodType
    {
        return $this->DigestMethod;
    }

    public function setDigestMethod(DigestMethodType $DigestMethod): self
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
     */
    public function setDigestValue($DigestValue): self
    {
        $this->DigestValue = $DigestValue;

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

    public function getURI(): AnyURI
    {
        return $this->URI;
    }

    public function setURI(AnyURI $URI): self
    {
        $this->URI = $URI;

        return $this;
    }

    public function getType(): AnyURI
    {
        return $this->Type;
    }

    public function setType(AnyURI $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
