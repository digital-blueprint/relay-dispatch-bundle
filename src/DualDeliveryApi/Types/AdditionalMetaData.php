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

    /**
     * @return AdditionalMetaDataSetType
     */
    public function getAdditionalMetaDataSet()
    {
        return $this->AdditionalMetaDataSet;
    }

    /**
     * @param AdditionalMetaDataSetType $AdditionalMetaDataSet
     *
     * @return AdditionalMetaData
     */
    public function setAdditionalMetaDataSet($AdditionalMetaDataSet)
    {
        $this->AdditionalMetaDataSet = $AdditionalMetaDataSet;

        return $this;
    }
}
