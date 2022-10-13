<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class RetrievalMethodType
{
    /**
     * @var TransformsType
     */
    protected $Transforms = null;

    /**
     * @var AnyURI
     */
    protected $URI = null;

    /**
     * @var AnyURI
     */
    protected $Type = null;

    /**
     * @param AnyURI $URI
     * @param AnyURI $Type
     */
    public function __construct($URI, $Type)
    {
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
     * @return RetrievalMethodType
     */
    public function setTransforms($Transforms)
    {
        $this->Transforms = $Transforms;

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
     * @return RetrievalMethodType
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
     * @return RetrievalMethodType
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }
}
