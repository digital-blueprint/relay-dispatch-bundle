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
     * @var base64Binary
     */
    protected $Value = null;

    /**
     * @param string       $AlgorithmID
     * @param base64Binary $Value
     */
    public function __construct($AlgorithmID, $Value)
    {
        $this->AlgorithmID = $AlgorithmID;
        $this->Value = $Value;
    }

    /**
     * @return string
     */
    public function getAlgorithmID()
    {
        return $this->AlgorithmID;
    }

    /**
     * @param string $AlgorithmID
     *
     * @return Checksum
     */
    public function setAlgorithmID($AlgorithmID)
    {
        $this->AlgorithmID = $AlgorithmID;

        return $this;
    }

    /**
     * @return base64Binary
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     * @param base64Binary $Value
     *
     * @return Checksum
     */
    public function setValue($Value)
    {
        $this->Value = $Value;

        return $this;
    }
}
