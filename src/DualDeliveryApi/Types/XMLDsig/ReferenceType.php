<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

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
     * @var string
     */
    protected $DigestValue;

    /**
     * @var string
     */
    protected $Id;

    /**
     * @var string
     */
    protected $URI;

    /**
     * @var string
     */
    protected $Type;

    /**
     * @param TransformsType   $Transforms
     * @param DigestMethodType $DigestMethod
     * @param string           $DigestValue
     * @param string           $Id
     * @param string           $URI
     * @param string           $Type
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
     * @return string
     */
    public function getDigestValue()
    {
        return $this->DigestValue;
    }

    /**
     * @param string $DigestValue
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

    public function getURI(): string
    {
        return $this->URI;
    }

    public function setURI(string $URI): self
    {
        $this->URI = $URI;

        return $this;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
