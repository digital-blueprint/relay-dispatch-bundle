<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class RecipientType
{
    /**
     * @var PersonDataType
     */
    protected $RecipientData = null;

    /**
     * @var ParametersType
     */
    protected $Parameters = null;

    /**
     * @param PersonDataType $RecipientData
     * @param ParametersType $Parameters
     */
    public function __construct($RecipientData, $Parameters = null)
    {
        $this->RecipientData = $RecipientData;
        $this->Parameters = $Parameters;
    }

    public function getRecipientData(): PersonDataType
    {
        return $this->RecipientData;
    }

    public function setRecipientData(PersonDataType $RecipientData): self
    {
        $this->RecipientData = $RecipientData;

        return $this;
    }

    public function getParameters(): ParametersType
    {
        return $this->Parameters;
    }

    public function setParameters(ParametersType $Parameters): self
    {
        $this->Parameters = $Parameters;

        return $this;
    }
}
