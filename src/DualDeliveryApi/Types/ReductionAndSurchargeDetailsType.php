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

    public function getReduction(): ReductionAndSurchargeType
    {
        return $this->Reduction;
    }

    public function setReduction(ReductionAndSurchargeType $Reduction): self
    {
        $this->Reduction = $Reduction;

        return $this;
    }

    public function getSurcharge(): ReductionAndSurchargeType
    {
        return $this->Surcharge;
    }

    public function setSurcharge(ReductionAndSurchargeType $Surcharge): self
    {
        $this->Surcharge = $Surcharge;

        return $this;
    }

    public function getReductionAndSurchargeDetailsExtension(): ReductionAndSurchargeDetailsExtensionType
    {
        return $this->ReductionAndSurchargeDetailsExtension;
    }

    public function setReductionAndSurchargeDetailsExtension(ReductionAndSurchargeDetailsExtensionType $ReductionAndSurchargeDetailsExtension): self
    {
        $this->ReductionAndSurchargeDetailsExtension = $ReductionAndSurchargeDetailsExtension;

        return $this;
    }
}
