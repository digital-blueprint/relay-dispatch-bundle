<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDeliveryNotification;

class AdditionalResults
{
    /**
     * @var AdditonalResultSetType[]
     */
    protected $AdditonalResultSet = null;

    /**
     * @param AdditonalResultSetType[] $AdditonalResultSet
     */
    public function __construct(array $AdditonalResultSet)
    {
        $this->AdditonalResultSet = $AdditonalResultSet;
    }

    /**
     * @return AdditonalResultSetType[]
     */
    public function getAdditonalResultSet(): array
    {
        return $this->AdditonalResultSet;
    }

    /**
     * @param AdditonalResultSetType[] $AdditonalResultSet
     */
    public function setAdditonalResultSet(array $AdditonalResultSet): void
    {
        $this->AdditonalResultSet = $AdditonalResultSet;
    }
}
