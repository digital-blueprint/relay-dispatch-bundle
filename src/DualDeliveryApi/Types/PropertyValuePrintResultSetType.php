<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class PropertyValuePrintResultSetType extends AdditionalPrintResultSetType
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

    public function getParameter(): ParameterType
    {
        return $this->Parameter;
    }

    public function setParameter(ParameterType $Parameter): self
    {
        $this->Parameter = $Parameter;

        return $this;
    }
}
