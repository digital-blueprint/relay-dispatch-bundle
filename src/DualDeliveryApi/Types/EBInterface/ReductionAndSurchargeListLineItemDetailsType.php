<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types\EBInterface;

class ReductionAndSurchargeListLineItemDetailsType
{
    /**
     * @var ReductionAndSurchargeBaseType
     */
    protected $ReductionListLineItem;

    /**
     * @var ReductionAndSurchargeBaseType
     */
    protected $SurchargeListLineItem;

    /**
     * @param ReductionAndSurchargeBaseType $ReductionListLineItem
     * @param ReductionAndSurchargeBaseType $SurchargeListLineItem
     */
    public function __construct($ReductionListLineItem, $SurchargeListLineItem)
    {
        $this->ReductionListLineItem = $ReductionListLineItem;
        $this->SurchargeListLineItem = $SurchargeListLineItem;
    }

    public function getReductionListLineItem(): ReductionAndSurchargeBaseType
    {
        return $this->ReductionListLineItem;
    }

    public function setReductionListLineItem(ReductionAndSurchargeBaseType $ReductionListLineItem): self
    {
        $this->ReductionListLineItem = $ReductionListLineItem;

        return $this;
    }

    public function getSurchargeListLineItem(): ReductionAndSurchargeBaseType
    {
        return $this->SurchargeListLineItem;
    }

    public function setSurchargeListLineItem(ReductionAndSurchargeBaseType $SurchargeListLineItem): self
    {
        $this->SurchargeListLineItem = $SurchargeListLineItem;

        return $this;
    }
}
