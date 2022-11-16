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

    public function __construct(string $AlgorithmID, string $Value)
    {
        $this->AlgorithmID = $AlgorithmID;
        $this->Value = $Value;
    }

    public function getAlgorithmID(): string
    {
        return $this->AlgorithmID;
    }

    public function setAlgorithmID(string $AlgorithmID): void
    {
        $this->AlgorithmID = $AlgorithmID;
    }

    public function getValue(): string
    {
        return $this->Value;
    }

    public function setValue(string $Value): void
    {
        $this->Value = $Value;
    }
}
