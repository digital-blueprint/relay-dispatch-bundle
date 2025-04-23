<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class RetrievalMethodType
{
    /**
     * @var TransformsType
     */
    protected $Transforms;

    /**
     * @var string
     */
    protected $URI;

    /**
     * @var string
     */
    protected $Type;

    /**
     * @param string $URI
     * @param string $Type
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
