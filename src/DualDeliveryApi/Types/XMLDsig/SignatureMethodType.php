<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\AnyURI;

class SignatureMethodType
{
    /**
     * @var HMACOutputLengthType
     */
    protected $HMACOutputLength = null;

    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var AnyURI
     */
    protected $Algorithm = null;

    /**
     * @param string $any
     * @param AnyURI $Algorithm
     */
    public function __construct($any, $Algorithm)
    {
        $this->any = $any;
        $this->Algorithm = $Algorithm;
    }

    /**
     * @return HMACOutputLengthType
     */
    public function getHMACOutputLength()
    {
        return $this->HMACOutputLength;
    }

    /**
     * @param HMACOutputLengthType $HMACOutputLength
     */
    public function setHMACOutputLength($HMACOutputLength): self
    {
        $this->HMACOutputLength = $HMACOutputLength;

        return $this;
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

    public function getAlgorithm(): AnyURI
    {
        return $this->Algorithm;
    }

    public function setAlgorithm(AnyURI $Algorithm): self
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
