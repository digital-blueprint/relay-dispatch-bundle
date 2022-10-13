<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReductionAndSurchargeListLineItemDetailsType
{
    /**
     * @var ReductionAndSurchargeBaseType
     */
    protected $ReductionListLineItem = null;

    /**
     * @var ReductionAndSurchargeBaseType
     */
    protected $SurchargeListLineItem = null;

    /**
     * @param ReductionAndSurchargeBaseType $ReductionListLineItem
     * @param ReductionAndSurchargeBaseType $SurchargeListLineItem
     */
    public function __construct($ReductionListLineItem, $SurchargeListLineItem)
    {
        $this->ReductionListLineItem = $ReductionListLineItem;
        $this->SurchargeListLineItem = $SurchargeListLineItem;
    }

    /**
     * @return ReductionAndSurchargeBaseType
     */
    public function getReductionListLineItem()
    {
        return $this->ReductionListLineItem;
    }

    /**
     * @param ReductionAndSurchargeBaseType $ReductionListLineItem
     *
     * @return ReductionAndSurchargeListLineItemDetailsType
     */
    public function setReductionListLineItem($ReductionListLineItem)
    {
        $this->ReductionListLineItem = $ReductionListLineItem;

        return $this;
    }

    /**
     * @return ReductionAndSurchargeBaseType
     */
    public function getSurchargeListLineItem()
    {
        return $this->SurchargeListLineItem;
    }

    /**
     * @param ReductionAndSurchargeBaseType $SurchargeListLineItem
     *
     * @return ReductionAndSurchargeListLineItemDetailsType
     */
    public function setSurchargeListLineItem($SurchargeListLineItem)
    {
        $this->SurchargeListLineItem = $SurchargeListLineItem;

        return $this;
    }
}
