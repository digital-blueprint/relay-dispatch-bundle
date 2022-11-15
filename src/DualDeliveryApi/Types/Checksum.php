<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Checksum
{
    /**
     * @var string
     */
    protected $AlgorithmID = null;

    /**
     * @var string
     */
    protected $Value = null;

    /**
     * @param string $AlgorithmID
     * @param string $Value
     */
    public function __construct($AlgorithmID, $Value)
    {
        $this->AlgorithmID = $AlgorithmID;
        $this->Value = $Value;
    }

    public function getAlgorithmID(): string
    {
        return $this->AlgorithmID;
    }

    public function setAlgorithmID(string $AlgorithmID): self
    {
        $this->AlgorithmID = $AlgorithmID;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param string $Value
     */
    public function setValue($Value): self
    {
        $this->Value = $Value;

        return $this;
    }
}
