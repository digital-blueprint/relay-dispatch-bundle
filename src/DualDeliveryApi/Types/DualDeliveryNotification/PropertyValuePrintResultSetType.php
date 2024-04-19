<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery\ParameterType;

class PropertyValuePrintResultSetType extends AdditionalPrintResultSetType
{
    /**
     * @var ParameterType
     */
    protected $Parameter;

    public function __construct(ParameterType $Parameter)
    {
        parent::__construct();
        $this->Parameter = $Parameter;
    }

    public function getParameter(): ParameterType
    {
        return $this->Parameter;
    }

    public function setParameter(ParameterType $Parameter): void
    {
        $this->Parameter = $Parameter;
    }
}
