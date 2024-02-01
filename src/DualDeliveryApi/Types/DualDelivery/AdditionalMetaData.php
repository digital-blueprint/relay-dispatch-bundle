<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\DualDelivery;

class AdditionalMetaData
{
    /**
     * @var AdditionalMetaDataSetType[]
     */
    protected $AdditionalMetaDataSet;

    /**
     * @param AdditionalMetaDataSetType[] $AdditionalMetaDataSet
     */
    public function __construct(array $AdditionalMetaDataSet)
    {
        $this->AdditionalMetaDataSet = $AdditionalMetaDataSet;
    }

    /**
     * @return AdditionalMetaDataSetType[]
     */
    public function getAdditionalMetaDataSet(): array
    {
        return $this->AdditionalMetaDataSet;
    }

    /**
     * @param AdditionalMetaDataSetType[] $AdditionalMetaDataSet
     */
    public function setAdditionalMetaDataSet(array $AdditionalMetaDataSet): void
    {
        $this->AdditionalMetaDataSet = $AdditionalMetaDataSet;
    }
}
