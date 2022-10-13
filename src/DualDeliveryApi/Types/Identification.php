<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class Identification
{
    /**
     * @var string
     */
    protected $Type = null;

    /**
     * @var string
     */
    protected $Value = null;

    /**
     * @param string $Type
     * @param string $Value
     */
    public function __construct($Type, $Value)
    {
        $this->Type = $Type;
        $this->Value = $Value;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Type
     *
     * @return stringentification
     */
    public function setType($Type)
    {
        $this->Type = $Type;

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
     *
     * @return stringentification
     */
    public function setValue($Value)
    {
        $this->Value = $Value;

        return $this;
    }
}
