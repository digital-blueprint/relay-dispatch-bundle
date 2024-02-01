<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class ParametersType
{
    /**
     * @var ParameterType[]
     */
    protected $Parameter;

    /**
     * @param ParameterType[] $Parameter
     */
    public function __construct(array $Parameter)
    {
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
