<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AdditonalPrintResults
{
    /**
     * @var AdditionalPrintResultSetType
     */
    protected $AdditionalPrintResultSet = null;

    /**
     * @param AdditionalPrintResultSetType $AdditionalPrintResultSet
     */
    public function __construct($AdditionalPrintResultSet)
    {
        $this->AdditionalPrintResultSet = $AdditionalPrintResultSet;
    }

    public function getAdditionalPrintResultSet(): AdditionalPrintResultSetType
    {
        return $this->AdditionalPrintResultSet;
    }

    public function setAdditionalPrintResultSet(AdditionalPrintResultSetType $AdditionalPrintResultSet): void
    {
        $this->AdditionalPrintResultSet = $AdditionalPrintResultSet;
    }
}
