<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

use Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryPersonData\PersonDataType;

class RecipientType
{
    /**
     * @var PersonDataType
     */
    protected $RecipientData = null;

    /**
     * @var ?ParametersType
     */
    protected $Parameters = null;

    public function __construct(PersonDataType $RecipientData, ?ParametersType $Parameters = null)
    {
        $this->RecipientData = $RecipientData;
        $this->Parameters = $Parameters;
    }

    public function getRecipientData(): PersonDataType
    {
        return $this->RecipientData;
    }

    public function setRecipientData(PersonDataType $RecipientData): void
    {
        $this->RecipientData = $RecipientData;
    }

    public function getParameters(): ?ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): void
    {
        $this->Parameters = $Parameters;
    }
}
