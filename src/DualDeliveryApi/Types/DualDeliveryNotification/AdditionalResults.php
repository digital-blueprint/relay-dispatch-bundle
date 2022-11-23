<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class AdditionalResults
{
    /**
     * @var AdditonalResultSetType
     */
    protected $AdditonalResultSet = null;

    /**
     * @param AdditonalResultSetType $AdditonalResultSet
     */
    public function __construct($AdditonalResultSet)
    {
        $this->AdditonalResultSet = $AdditonalResultSet;
    }

    public function getAdditonalResultSet(): AdditonalResultSetType
    {
        return $this->AdditonalResultSet;
    }

    public function setAdditonalResultSet(AdditonalResultSetType $AdditonalResultSet): self
    {
        $this->AdditonalResultSet = $AdditonalResultSet;

        return $this;
    }
}
