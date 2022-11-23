<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class PropertyValuePrintParameterSetType extends AdditionalPrintParameterSetType
{
    /**
     * @var ParameterType[]
     */
    protected $Parameter = null;

    /**
     * @param ParameterType[] $Parameter
     */
    public function __construct(array $Parameter)
    {
        parent::__construct();
        $this->Parameter = $Parameter;
    }

    /**
     * @return ParameterType[]
     */
    public function getParameter(): array
    {
        return $this->Parameter;
    }

    /**
     * @param ParameterType[] $Parameter
     */
    public function setParameter(array $Parameter): void
    {
        $this->Parameter = $Parameter;
    }
}
