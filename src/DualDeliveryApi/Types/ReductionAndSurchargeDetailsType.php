<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\DualDeliveryApi\Types;

class ReductionAndSurchargeDetailsType
{
    /**
     * @var ReductionAndSurchargeType
     */
    protected $Reduction = null;

    /**
     * @var ReductionAndSurchargeType
     */
    protected $Surcharge = null;

    /**
     * @var ReductionAndSurchargeDetailsExtensionType
     */
    protected $ReductionAndSurchargeDetailsExtension = null;

    /**
     * @param ReductionAndSurchargeType                 $Reduction
     * @param ReductionAndSurchargeType                 $Surcharge
     * @param ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension
     */
    public function __construct($Reduction, $Surcharge, $ReductionAndSurchargeDetailsExtension)
    {
        $this->Reduction = $Reduction;
        $this->Surcharge = $Surcharge;
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;
    }

    /**
     * @return ReductionAndSurchargeType
     */
    public function getReduction()
    {
        return $this->Reduction;
    }

    /**
     * @param ReductionAndSurchargeType $Reduction
     *
     * @return ReductionAndSurchargeDetailsType
     */
    public function setReduction($Reduction)
    {
        $this->Reduction = $Reduction;

        return $this;
    }

    /**
     * @return ReductionAndSurchargeType
     */
    public function getSurcharge()
    {
        return $this->Surcharge;
    }

    /**
     * @param ReductionAndSurchargeType $Surcharge
     *
     * @return ReductionAndSurchargeDetailsType
     */
    public function setSurcharge($Surcharge)
    {
        $this->Surcharge = $Surcharge;

        return $this;
    }

    /**
     * @return ReductionAndSurchargeDetailsExtensionType
     */
    public function getReductionAndSurchargeDetailsExtension()
    {
        return $this->ReductionAndSurchargeDetailsExtension;
    }

    /**
     * @param ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension
     *
     * @return ReductionAndSurchargeDetailsType
     */
    public function setReductionAndSurchargeDetailsExtension($ReductionAndSurchargeDetailsExtension)
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;

        return $this;
    }
}
