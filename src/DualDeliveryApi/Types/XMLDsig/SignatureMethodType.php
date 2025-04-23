<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class SignatureMethodType
{
    /**
     * @var int
     */
    protected $HMACOutputLength;

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

    /**
     * @return int
     */
    public function getHMACOutputLength()
    {
        return $this->HMACOutputLength;
    }

    /**
     * @param int $HMACOutputLength
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
