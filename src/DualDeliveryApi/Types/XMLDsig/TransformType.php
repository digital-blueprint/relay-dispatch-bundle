<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\XMLDsig;

class TransformType
{
    /**
     * @var string
     */
    protected $any;

    /**
     * @var string
     */
    protected $XPath;

    /**
     * @var string
     */
    protected $Algorithm;

    /**
     * @param string $any
     * @param string $XPath
     * @param string $Algorithm
     */
    public function __construct($any, $XPath, $Algorithm)
    {
        $this->any = $any;
        $this->XPath = $XPath;
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

    public function getXPath(): string
    {
        return $this->XPath;
    }

    public function setXPath(string $XPath): self
    {
        $this->XPath = $XPath;

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
