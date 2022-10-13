<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class TransformType
{
    /**
     * @var string
     */
    protected $any = null;

    /**
     * @var string
     */
    protected $XPath = null;

    /**
     * @var AnyURI
     */
    protected $Algorithm = null;

    /**
     * @param string $any
     * @param string $XPath
     * @param AnyURI $Algorithm
     */
    public function __construct($any, $XPath, $Algorithm)
    {
        $this->any = $any;
        $this->XPath = $XPath;
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
     * @return TransformType
     */
    public function setAny($any)
    {
        $this->any = $any;

        return $this;
    }

    /**
     * @return string
     */
    public function getXPath()
    {
        return $this->XPath;
    }

    /**
     * @param string $XPath
     *
     * @return TransformType
     */
    public function setXPath($XPath)
    {
        $this->XPath = $XPath;

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
     * @return TransformType
     */
    public function setAlgorithm($Algorithm)
    {
        $this->Algorithm = $Algorithm;

        return $this;
    }
}
