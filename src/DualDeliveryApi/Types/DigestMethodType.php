<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class DigestMethodType
{
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
     * @return string
     */
    public function getAny()
    {
        return $this->any;
    }

    /**
     * @param string $any
     *
     * @return DigestMethodType
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
     * @return DigestMethodType
     */
    public function setAlgorithm($Algorithm)
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
