<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AdditionalPrintParameter
{
    /**
     * @var AdditionalPrintParameterSetType
     */
    protected $AdditionalPrintParameterSet = null;

    /**
     * @param AdditionalPrintParameterSetType $AdditionalPrintParameterSet
     */
    public function __construct($AdditionalPrintParameterSet)
    {
        $this->AdditionalPrintParameterSet = $AdditionalPrintParameterSet;
    }

    public function getAdditionalPrintParameterSet(): AdditionalPrintParameterSetType
    {
        return $this->AdditionalPrintParameterSet;
    }

    public function setAdditionalPrintParameterSet(AdditionalPrintParameterSetType $AdditionalPrintParameterSet): self
    {
        $this->AdditionalPrintParameterSet = $AdditionalPrintParameterSet;

        return $this;
    }
}
