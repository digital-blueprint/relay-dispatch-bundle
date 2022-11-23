<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

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

    public function getTransforms(): TransformsType
    {
        return $this->Transforms;
    }

    public function setTransforms(TransformsType $Transforms): self
    {
        $this->Transforms = $Transforms;

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
