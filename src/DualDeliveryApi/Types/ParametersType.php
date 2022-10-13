<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ParametersType
{
    /**
     * @var ParameterType
     */
    protected $Parameter = null;

    /**
     * @param ParameterType $Parameter
     */
    public function __construct($Parameter)
    {
        $this->Parameter = $Parameter;
    }

    /**
     * @return ParameterType
     */
    public function getParameter()
    {
        return $this->Parameter;
    }

    /**
     * @param ParameterType $Parameter
     *
     * @return ParametersType
     */
    public function setParameter($Parameter)
    {
        $this->Parameter = $Parameter;

        return $this;
    }
}
