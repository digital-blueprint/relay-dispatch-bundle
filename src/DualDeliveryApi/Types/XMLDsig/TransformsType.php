<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class TransformsType
{
    /**
     * @var TransformType
     */
    protected $Transform;

    /**
     * @param TransformType $Transform
     */
    public function __construct($Transform)
    {
        $this->Transform = $Transform;
    }

    public function getTransform(): TransformType
    {
        return $this->Transform;
    }

    public function setTransform(TransformType $Transform): self
    {
        $this->Transform = $Transform;

        return $this;
    }
}
