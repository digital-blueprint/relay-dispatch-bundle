<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class AdditionalMetaData
{
    /**
     * @var AdditionalMetaDataSetType
     */
    protected $AdditionalMetaDataSet = null;

    /**
     * @param AdditionalMetaDataSetType $AdditionalMetaDataSet
     */
    public function __construct($AdditionalMetaDataSet)
    {
        $this->AdditionalMetaDataSet = $AdditionalMetaDataSet;
    }

    public function getAdditionalMetaDataSet(): AdditionalMetaDataSetType
    {
        return $this->AdditionalMetaDataSet;
    }

    public function setAdditionalMetaDataSet(AdditionalMetaDataSetType $AdditionalMetaDataSet): self
    {
        $this->AdditionalMetaDataSet = $AdditionalMetaDataSet;

        return $this;
    }
}
