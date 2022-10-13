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

    /**
     * @return AdditionalPrintParameterSetType
     */
    public function getAdditionalPrintParameterSet()
    {
        return $this->AdditionalPrintParameterSet;
    }

    /**
     * @param AdditionalPrintParameterSetType $AdditionalPrintParameterSet
     *
     * @return AdditionalPrintParameter
     */
    public function setAdditionalPrintParameterSet($AdditionalPrintParameterSet)
    {
        $this->AdditionalPrintParameterSet = $AdditionalPrintParameterSet;

        return $this;
    }
}
