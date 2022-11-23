<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class AdditionalPrintParameter
{
    /**
     * @var AdditionalPrintParameterSetType[]
     */
    protected $AdditionalPrintParameterSet = null;

    /**
     * @param AdditionalPrintParameterSetType[] $AdditionalPrintParameterSet
     */
    public function __construct(array $AdditionalPrintParameterSet)
    {
        $this->AdditionalPrintParameterSet = $AdditionalPrintParameterSet;
    }

    /**
     * @return AdditionalPrintParameterSetType[]
     */
    public function getAdditionalPrintParameterSet(): array
    {
        return $this->AdditionalPrintParameterSet;
    }

    /**
     * @param AdditionalPrintParameterSetType[] $AdditionalPrintParameterSet
     */
    public function setAdditionalPrintParameterSet(array $AdditionalPrintParameterSet): void
    {
        $this->AdditionalPrintParameterSet = $AdditionalPrintParameterSet;
    }
}
