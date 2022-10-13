<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class CanonicalizationMethodType
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
     * @return CanonicalizationMethodType
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
     * @return CanonicalizationMethodType
     */
    public function setAlgorithm($Algorithm)
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
