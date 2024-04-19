<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class AdditonalPrintResults
{
    /**
     * @var AdditionalPrintResultSetType
     */
    protected $AdditionalPrintResultSet;

    /**
     * @var PropertyValuePrintResultSetType
     */
    protected $PropertyValuePrintResultSet;

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

    public function getPropertyValuePrintResultSet(): PropertyValuePrintResultSetType
    {
        return $this->PropertyValuePrintResultSet;
    }

    public function setAdditionalPrintResultSet(AdditionalPrintResultSetType $AdditionalPrintResultSet): void
    {
        $this->AdditionalPrintResultSet = $AdditionalPrintResultSet;
    }
}
