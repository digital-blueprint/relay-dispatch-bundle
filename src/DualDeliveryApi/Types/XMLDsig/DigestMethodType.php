<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class DigestMethodType
{
    /**
     * @var string
     */
    protected $any;

    /**
     * @var string
     */
    protected $Algorithm;

    /**
     * @param string $any
     * @param string $Algorithm
     */
    public function __construct($any, $Algorithm)
    {
        $this->any = $any;
        $this->Algorithm = $Algorithm;
    }

    public function getAny(): string
    {
        return $this->any;
    }

    public function setAny(string $any): self
    {
        $this->any = $any;

        return $this;
    }

    public function getAlgorithm(): string
    {
        return $this->Algorithm;
    }

    public function setAlgorithm(string $Algorithm): self
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
