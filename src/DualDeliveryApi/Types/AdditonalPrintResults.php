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

    /**
     * @return AdditionalPrintResultSetType
     */
    public function getAdditionalPrintResultSet()
    {
        return $this->AdditionalPrintResultSet;
    }

    /**
     * @param AdditionalPrintResultSetType $AdditionalPrintResultSet
     *
     * @return AdditonalPrintResults
     */
    public function setAdditionalPrintResultSet($AdditionalPrintResultSet)
    {
        $this->AdditionalPrintResultSet = $AdditionalPrintResultSet;

        return $this;
    }
}
