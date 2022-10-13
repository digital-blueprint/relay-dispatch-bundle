<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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
     *
     * @return SignatureMethodType
     */
    public function setHMACOutputLength($HMACOutputLength)
    {
        $this->HMACOutputLength = $HMACOutputLength;

        return $this;
    }

    /**
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return SignatureMethodType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return AnyURI
     */
    public function getAlgorithm()
    {
        return $this->Algorithm;
    }

    /**
     * @param AnyURI $Algorithm
     *
     * @return SignatureMethodType
     */
    public function setAlgorithm($Algorithm)
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
