<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

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

    /**
     * @return AdditonalResultSetType
     */
    public function getAdditonalResultSet()
    {
        return $this->AdditonalResultSet;
    }

    /**
     * @param AdditonalResultSetType $AdditonalResultSet
     *
     * @return AdditionalResults
     */
    public function setAdditonalResultSet($AdditonalResultSet)
    {
        $this->AdditonalResultSet = $AdditonalResultSet;

        return $this;
    }
}
